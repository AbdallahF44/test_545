<?php

namespace Tests\Feature\Students\Auth;

use App\Modules\Students\Models\Student;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_email_verification_screen_can_be_rendered(): void
    {
        $student = Student::factory()->create([
            'email_verified_at' => null,
        ]);

        $response = $this->actingAs($student, 'student')->get('/student/verify-email');

        $response->assertStatus(200);
    }

    public function test_email_can_be_verified(): void
    {
        $student = Student::factory()->create([
            'email_verified_at' => null,
        ]);

        Event::fake();

        $verificationUrl = URL::temporarySignedRoute(
            'student.verification.verify',
            now()->addMinutes(60),
            ['id' => $student->id, 'hash' => sha1($student->email)]
        );

        $response = $this->actingAs($student, 'student')->get($verificationUrl);

        Event::assertDispatched(Verified::class);
        $this->assertTrue($student->fresh()->hasVerifiedEmail());
        $response->assertRedirect('/student'.'?verified=1');
    }

    public function test_email_is_not_verified_with_invalid_hash(): void
    {
        $student = Student::factory()->create([
            'email_verified_at' => null,
        ]);

        $verificationUrl = URL::temporarySignedRoute(
            'student.verification.verify',
            now()->addMinutes(60),
            ['id' => $student->id, 'hash' => sha1('wrong-email')]
        );

        $this->actingAs($student, 'student')->get($verificationUrl);

        $this->assertFalse($student->fresh()->hasVerifiedEmail());
    }
}
