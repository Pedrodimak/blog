<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function visit_register_view()
    {
        //Obtenemos la ruta create con el formulario crear post
        $this->get('/register')
            ->assertStatus(200)
            ->assertSee('Registro');
    }

    /** @test */
    public function user_can_see_register_form()
    {
        //Obtenemos la ruta create con el formulario crear post
        $this->get('/register')
            ->assertSee('Formulario de Registro')
            ->assertSee('Nombre Completo')
            ->assertSee('Nombre de Pila')
            ->assertSee('Email')
            ->assertSee('Contraseña de Acceso');
    }

    /** @test */
    public function user_registers()
    {
        $this->withoutExceptionHandling();

        User::factory()->create();

        $this->post('/register/store', [
                'name' => 'Name Test',
                'nickname' => 'Nickname Test',
                'email' => 'test@gmail.com',
                'password' => '1234'
        ]);

        $this->assertDatabaseCount('users', 2);
    }

    /** @test */
    public function user_already_register()
    {
        $usercreated = User::factory()->create();

        $this->post('/register/store', [
                'name' => 'Name Test',
                'nickname' => 'Nickname Test',
                'email' => $usercreated->email,
                'password' => '1234'
        ]);

        $this->assertDatabaseCount('users', 1);
    }
}
