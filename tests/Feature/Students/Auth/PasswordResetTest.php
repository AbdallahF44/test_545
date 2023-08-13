<?php

namespace Tests\Feature\Students\Auth;

use App\Modules\Students\Models\Student;
use App\Modules\Students\Notifications\Auth\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    public function test_reset_password_link_screen_can_be_rendered(): void
    {
        $response = $this->get('/student/forgot-password');

        $response->assertStatus(200);
    }

    public function test_reset_password_link_can_be_requested(): void
    {
        Notification::fake();

        $student = Student::factory()->create();

        $this->post('/student/forgot-password', ['email' => $student->email]);

        Notification::assertSentTo($student, ResetPassword::class);
    }

    public function test_reset_password_screen_can_be_rendered(): void
    {
        Notification::fake();

        $student = Student::factory()->create();

        $this->post('/student/forgot-password', ['email' => $student->email]);

        Notification::assertSentTo($student, ResetPassword::class, function ($notification) {
            $response = $this->get('/student/reset-password/'.$notification->token);

            $response->assertStatus(200);

            return true;
        });
    }

    public function test_password_can_be_reset_with_valid_token(): void
    {
        Notification::fake();

        $student = Student::factory()->create();

        $this->post('/student/forgot-password', ['email' => $student->email]);

        Notification::assertSentTo($student, ResetPassword::class, function ($notification) use ($student) {
            $response = $this->post('/student/reset-password', [
                'token' => $notification->token,
                'email' => $student->email,
                'password' => 'password',
                'password_confirmation' => 'password',
            ]);

            $response->assertSessionHasNoErrors();

            return true;
        });
    }
}
