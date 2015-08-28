<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DashboardTest extends TestCase
{
    //use DatabaseMigrations;

    public function testDashboardRequiresAuth()
    {
        $this->visit('/')->see('Login');
    }

    public function testDashboardWithAuth(){
        $user = factory(App\User::class)->create();
        dd($user);
        $this->visit();
    }

}
