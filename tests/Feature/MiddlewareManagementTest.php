<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MiddlewareManagementTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function unlogged_user_can_access_route_home()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function logged_user_cannot_access_route_home()
    {
        $this->loginTest();

        $response = $this->get('/');

        $response->assertStatus(302);
    }

    /** @test */
    public function unlogged_user_can_access_route_register()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    /** @test */
    public function logged_user_cannot_access_route_register()
    {
        $this->loginTest();

        $response = $this->get('/register');

        $response->assertStatus(302);
    }

    /** @test */
    public function unlogged_user_can_access_route_login()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    /** @test */
    public function logged_user_cannot_access_route_login()
    {
        $this->loginTest();

        $response = $this->get('/login');

        $response->assertStatus(302);
    }

    /** @test */
    public function unlogged_user_cannot_access_route_logged_home()
    {
        $response = $this->get('/logged/home');

        $response->assertStatus(404);
    }

    /** @test */
    public function logged_user_can_access_route_logged_home()
    {
        $this->loginTest();

        $response = $this->get('/logged/home');

        $response->assertStatus(200);
    }

    /** @test */
    public function unlogged_user_cannot_access_route_logged_logout()
    {
        $response = $this->get('/logged/logout');

        $response->assertStatus(404);
    }

    /** @test */
    public function logged_user_can_access_route_logged_logout()
    {
        $this->loginTest();
        
        $response = $this->get('/logged/logout');

        $response->assertRedirect('/')
                ->assertStatus(302);
    }

    /** @test */
    public function unlogged_user_cannot_access_route_logged_edit()
    {
        $response = $this->get('/logged/edit');

        $response->assertStatus(404);
    }

    /** @test */
    public function logged_user_can_access_route_logged_edit()
    {
        $this->loginTest();
        
        $response = $this->get('/logged/edit');

        $response->assertStatus(200);
    }

    /** @test */
    public function unlogged_user_cannot_access_route_post_create()
    {
        $response = $this->get('/post/create');

        $response->assertStatus(404);
    }

    /** @test */
    public function logged_user_can_access_route_post_create()
    {
        $this->loginTest();
        
        $response = $this->get('/post/create');

        $response->assertStatus(200);
    }
}
