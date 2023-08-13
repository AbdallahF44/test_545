<?php

namespace Tests\Feature\Students\Auth;

use App\Modules\Students\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PasswordUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_password_can_be_updated(): void
    {
        $student = Student::factory()->create();

        $response = $this
            ->actingAs($student, 'student')
            ->from('/student/profile')
            ->put('/student/password', [
                'current_password' => 'password',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/student/profile');

        $this->assertTrue(Hash::check('new-password', $student->refresh()->password));
    }

    public function test_correct_password_must_be_provided_to_update_password(): void
    {
        $student = Student::factory()->create();

        $response = $this
            ->actingAs($student, 'student')
            ->from('/student/profile')
            ->put('/student/password', [
                'current_password' => 'wrong-password',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ]);

        $response
            ->assertSessionHasErrorsIn('updatePassword', 'current_password')
            ->assertRedirect('/student/profile');
    }
}
