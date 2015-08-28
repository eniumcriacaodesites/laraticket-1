<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
    use DatabaseMigrations;

    public function testLoginPageVisible()
    {
        $this->visit('auth/login')
            ->see('Login');
    }

    public function testLoginPageSubmitInvalidUserShowsError()
    {
        $this->visit('auth/login')
            ->see('Login');
        $user = factory(App\User::class)->make();
        $this->visit('auth/login')
            ->type($user->email, 'email')
            ->type($user->password, 'password')
            ->press('Submit')
            ->seePageIs('auth/login')
            ->see('These credentials do not match our records');
    }

    public function testLoginPageSubmitValidUserShowsDashboard()
    {
        $this->visit('auth/login')
            ->see('Login');
        $password = $this->faker->password();
        $user = factory(App\User::class)->create();
        $user->password = Hash::make($password);
        $user->save();
        $this->visit('auth/login')
            ->type($user->email, 'email')
            ->type($password, 'password')
            ->press('Submit')
            ->seePageIs('/');
    }

    public function testLoginPasswordResetLinkGoesToResetPage(){
        $this->visit('auth/login')
            ->click('Click Here To Reset Your Password')
            ->seePageIs('password/email');
    }

    public function testPasswordResetSubmitInvalidUserShowsError(){
        $user = factory(App\User::class)->make();
        $this->visit('password/email')
            ->type($user->email, 'email')
            ->press('Submit')
            ->seePageIs('password/email')
            ->see('We can\'t find a user with that e-mail address.');
    }

    public function testPasswordResetSubmitValidUserShowsError(){
        $user = factory(App\User::class)->create();
        $this->visit('password/email')
            ->type($user->email, 'email')
            ->press('Submit')
            ->seePageIs('password/email')
            ->see('We have e-mailed your password reset link!');
    }

    //TODO -- Test email sent
    //TODO -- Test /password/reset/token w/form submission

    public function testLogoutReturnsToLoginForm(){
        $user = factory(App\User::class)->create();
        $this->actingAs($user)
            ->visit('auth/logout')
            ->seePageIs('auth/login');
    }

}
