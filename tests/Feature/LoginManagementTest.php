<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class LoginManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_login_screen_can_be_rendered()
    {
        $response = $this->get('/login')
            ->assertStatus(200)
            ->assertSee('Inicio de Sesión');

        $response->assertOk();
    }

    /** @test */
    public function user_can_see_login_form()
    {
        $this->get('/login')
            ->assertSee('Formulario de Inicio de Sesión')
            ->assertSee('Introduzca su Email')
            ->assertSee('Introduzca su Contraseña de Acceso');
    }

    /** @test */
    public function user_with_correct_credentials_logs_in()
    {
        $usercreated = User::factory()->create();

        $response = $this->post('/login/authenticate', [
            'email' => $usercreated->email,
            'password' => '1234',
        ]);

        $userbdd = User::find(1);

        //El id del usuario de la sesion sea el mismo del de la base de datos
        $response->assertSessionHas(1, $userbdd->id);
        
        $this->assertEquals($usercreated->id, $userbdd->id);
        $response->assertRedirect('/logged/home');
        
    }

    /** @test */
    public function user_with_wrong_credentials_does_not_log_in()
    {
        $usercreated = User::factory()->create();

        $response = $this->post('/login/authenticate', [
            'email' => $usercreated->email,
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHas(null, null);
    }

    /** @test */
    public function user_logout()
    {
        $user = $this->loginTest();

        $response = $this->get('/logged/logout');

        $response->assertSessionMissing($user->id);

        $response->assertRedirect('/');
    }

    /** @test */
    public function the_email_is_required_for_authenticate()
    {
        User::factory()->create();

        $response = $this->post('/login/authenticate', [
            'email' => null,
            'password' => '1234',
        ]);

        $response->assertSessionHas(null, null);
    }

    /** @test */
    public function the_password_is_required_for_authenticate()
    {
        $usercreated = User::factory()->create();

        $response = $this->post('/login/authenticate', [
            'email' => $usercreated->email,
            'password' => null,
        ]);

        $response->assertSessionHas(null, null);
    }
}
