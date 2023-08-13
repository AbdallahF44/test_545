<?php

namespace Tests\Feature\Students\Auth;

use App\Modules\Students\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PasswordConfirmationTest extends TestCase
{
    use RefreshDatabase;

    public function test_confirm_password_screen_can_be_rendered(): void
    {
        $student = Student::factory()->create();

        $response = $this->actingAs($student, 'student')->get('/student/confirm-password');

        $response->assertStatus(200);
    }

    public function test_password_can_be_confirmed(): void
    {
        $student = Student::factory()->create();

        $response = $this->actingAs($student, 'student')->post('/student/confirm-password', [
            'password' => 'password',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }

    public function test_password_is_not_confirmed_with_invalid_password(): void
    {
        $student = Student::factory()->create();

        $response = $this->actingAs($student, 'student')->post('/student/confirm-password', [
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors();
    }
}
