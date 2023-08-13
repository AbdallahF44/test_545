<?php

namespace Tests\Feature\Students;

use App\Modules\Students\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_page_is_displayed(): void
    {
        $student = Student::factory()->create();

        $response = $this
            ->actingAs($student, 'student')
            ->get('/student/profile');

        $response->assertOk();
    }

    public function test_profile_information_can_be_updated(): void
    {
        $student = Student::factory()->create();

        $response = $this
            ->actingAs($student, 'student')
            ->patch('/student/profile', [
                'name' => 'Test Student',
                'email' => 'test@example.com',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/student/profile');

        $student->refresh();

        $this->assertSame('Test Student', $student->name);
        $this->assertSame('test@example.com', $student->email);
        $this->assertNull($student->email_verified_at);
    }

    public function test_email_verification_status_is_unchanged_when_the_email_address_is_unchanged(): void
    {
        $student = Student::factory()->create();

        $response = $this
            ->actingAs($student, 'student')
            ->patch('/student/profile', [
                'name' => 'Test Student',
                'email' => $student->email,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/student/profile');

        $this->assertNotNull($student->refresh()->email_verified_at);
    }

    public function test_student_can_delete_their_account(): void
    {
        $student = Student::factory()->create();

        $response = $this
            ->actingAs($student, 'student')
            ->delete('/student/profile', [
                'password' => 'password',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/student');

        $this->assertGuest('student');
        $this->assertNull($student->fresh());
    }

    public function test_correct_password_must_be_provided_to_delete_account(): void
    {
        $student = Student::factory()->create();

        $response = $this
            ->actingAs($student, 'student')
            ->from('/student/profile')
            ->delete('/student/profile', [
                'password' => 'wrong-password',
            ]);

        $response
            ->assertSessionHasErrorsIn('userDeletion', 'password')
            ->assertRedirect('/student/profile');

        $this->assertNotNull($student->fresh());
    }
}
