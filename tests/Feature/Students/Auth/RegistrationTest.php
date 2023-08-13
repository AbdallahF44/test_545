<?php

namespace Tests\Feature\Students\Auth;

use App\Modules\Students\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/student/register');

        $response->assertStatus(200);
    }

    public function test_new_students_can_register(): void
    {
        $response = $this->post('/student/register', [
            'name' => 'Test Student',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticatedAs(Student::first(), 'student');
        $response->assertRedirect('/student');
    }
}
