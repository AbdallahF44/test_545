<?php

namespace App\Modules\Students;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class StudentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes/student.php');

        Blade::component('student-app-layout', View\Components\StudentAppLayout::class);
        Blade::component('student-guest-layout', View\Components\StudentGuestLayout::class);
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        $this->registerMiddleware();
        $this->injectAuthConfiguration();
    }

    /**
     * @see https://laracasts.com/discuss/channels/general-discussion/register-middleware-via-service-provider
     */
    protected function registerMiddleware()
    {
        $router = $this->app['router'];
        $router->aliasMiddleware('student.auth', Http\Middleware\RedirectIfNotStudent::class);
        $router->aliasMiddleware('student.guest', Http\Middleware\RedirectIfStudent::class);
        $router->aliasMiddleware('student.verified', Http\Middleware\EnsureStudentEmailIsVerified::class);
        $router->aliasMiddleware('student.password.confirm', Http\Middleware\RequireStudentPassword::class);
    }

    protected function injectAuthConfiguration()
    {
        $this->app['config']->set('auth.guards.student', [
            'driver' => 'session',
            'provider' => 'students',
        ]);

        $this->app['config']->set('auth.providers.students', [
            'driver' => 'eloquent',
            'model' => Models\Student::class,
        ]);

        $this->app['config']->set('auth.passwords.students', [
            'provider' => 'students',
            'table' => 'student_password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ]);
    }
}
