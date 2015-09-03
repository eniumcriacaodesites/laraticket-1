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
        $falseUser = factory(App\User::class)->make();
        $this->visit('password/email')
            ->type($falseUser->email, 'email')
            ->press('Submit')
            ->seePageIs('password/email')
            ->see('We can\'t find a user with that e-mail address.');
    }

    public function testPasswordResetSubmitValidUserShowsSuccess(){
        $user = factory(App\User::class)->create();
        $this->visit('password/email')
            ->type($user->email, 'email')
            ->press('Submit')
            ->seePageIs('password/email')
            ->see('We have e-mailed your password reset link!');
    }

    public function testPasswordResetTokenLinkGoesToResetTokenPage(){
        $user = factory(App\User::class)->create();
        $this->visit('password/reset/'.$user->remember_token)
            ->see('Password Reset');
    }

    public function testPasswordResetTokenLinkSubmitInvalidUserShowsError(){
        $user = factory(App\User::class)->create();
        $this->visit('password/email')
            ->type($user->email, 'email')
            ->press('Submit')
            ->seePageIs('password/email');
        $passwordReset = \DB::table('password_resets')->where('email',$user->email)->first();
        $token = $passwordReset->token;
        $pageURL = 'password/reset/'.$token;
        $falseUser = factory(App\User::class)->make();
        $newPassword = $this->faker->password;
        $this->visit($pageURL)
            ->type($falseUser->email, 'email')
            ->type($newPassword, 'password')
            ->type($newPassword, 'password_confirmation')
            ->press('Reset Password')
            ->seePageIs($pageURL)
            ->see('We can\'t find a user with that e-mail address.');
    }

    public function testPasswordResetTokenLinkSubmitValidUserShowsSuccess(){
        $user = factory(App\User::class)->create();
        $this->visit('password/email')
            ->type($user->email, 'email')
            ->press('Submit')
            ->seePageIs('password/email');
        $passwordReset = \DB::table('password_resets')->where('email',$user->email)->first();
        $token = $passwordReset->token;
        $pageURL = 'password/reset/'.$token;
        $newPassword = $this->faker->password;
        $this->visit($pageURL)
            ->type($user->email, 'email')
            ->type($newPassword, 'password')
            ->type($newPassword, 'password_confirmation')
            ->press('Reset Password')
            ->see('Dashboard')
            ->seePageIs('/')
            ->visit('auth/logout')
            ->visit('auth/login')
            ->type($user->email, 'email')
            ->type($newPassword, 'password')
            ->press('Submit')
            ->seePageIs('/');
    }

    public function testLogoutReturnsToLoginForm(){
        $user = factory(App\User::class)->create();
        $this->actingAs($user)
            ->visit('auth/logout')
            ->seePageIs('auth/login');
    }

}
