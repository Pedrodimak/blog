<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function visit_edit_user_view()
    {
        //Iniciamos sesión
        $this->loginTest();
        //Obtenemos la ruta create con el formulario crear post
        $this->get('/logged/edit')
        ->assertStatus(200)
        ->assertSee('Editar Usuario');
    }

    /** @test */
    public function user_can_see_edit_user_form()
    {
        //Iniciamos sesión
        $this->loginTest();
        
        $this->get('/logged/edit')
            ->assertSee('Formulario para Editar un Usuario')
            ->assertSee('Nombre del Usuario')
            ->assertSee('Nickname')
            ->assertSee('Email')
            ->assertSee('Contraseña de Acceso');
    }
    
    /** @test */
    public function user_can_edit_and_update_their_data()
    {
        //Iniciamos sesión
        $this->loginTest();

        User::factory()->create();

        $this->patch('/logged/update', [
                'name' => 'Name Test',
                'nickname' => 'Nickname Test',
                'email' => 'test@gmail.com',
                'password' => '1234'
        ]);

        //Obtenemos el user, ya editado
        $user = User::first();
        //Comprobamos los datos si son los que hemos introducido
        $this->assertEquals($user->name, 'Name Test');
        $this->assertEquals($user->nickname, 'Nickname Test');
        $this->assertEquals($user->email, 'test@gmail.com');
    }

    public function logged_in_user_cannot_access_home()
    {
        //Iniciamos sesión
        $this->loginTest();

        //Obtenemos la ruta create con el formulario crear post
        $this->get('/')
        ->assertRedirect('/logged/home');
    }
}
