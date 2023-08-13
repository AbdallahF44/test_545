<?php

namespace Tests\Feature\Students\Auth;

use App\Modules\Students\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/student/login');

        $response->assertStatus(200);
    }

    public function test_students_can_authenticate_using_the_login_screen(): void
    {
        $student = Student::factory()->create();

        $response = $this->post('/student/login', [
            'email' => $student->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($student, 'student');
        $response->assertRedirect('/student');
    }

    public function test_students_can_not_authenticate_with_invalid_password(): void
    {
        $student = Student::factory()->create();

        $this->post('/student/login', [
            'email' => $student->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest('student');
    }
}
