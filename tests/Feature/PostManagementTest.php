<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function visit_create_post_view()
    {
        //Iniciamos sesión
        $this->loginTest();
        //Obtenemos la ruta create con el formulario crear post
        $this->get('post/create')
        ->assertStatus(200)
        ->assertSee('Crear Post');
    }

    /** @test */
    public function user_can_see_create_form()
    {
        //Iniciamos sesión
        $this->loginTest();

        $this->get('/post/create')
            ->assertSee('Formulario para Crear un Post')
            ->assertSee('Titulo del Post')
            ->assertSee('Descripción')
            ->assertSee('Categoría a la que pertenece');
    }

    /** @test */
    public function a_post_can_be_created_and_stored()
    {
        $this->withoutExceptionHandling();
        //Iniciamos sesión
        $this->loginTest();
        //Creamos una categoría que de forma predeterminada va a tener id 1
        $cat = (new Category([
            'title' => "a"
        ]))->save();
        //Hacemos una llamada HTTP enviando unos datos a la ruta que guarda los posts
        $this->post('/post/store', [
            'title' => 'Test Title',
            'description' => 'Test Description',
            'category_id' => '1',
            'user_id' => '1'
        ]);
        
        //Para comprobar si los datos están almacenados en la BBDD
        $this->assertDatabaseCount('posts', 1);
        //Extraemos el post
        $post = Post::first();
        //Comprobamos los datos si son los que hemos introducido
        $this->assertEquals($post->title, 'Test Title');
        $this->assertEquals($post->description, 'Test Description');
        $this->assertEquals($post->category_id, 1);
    }

    /** @test */
    public function visit_edit_post_view()
    {
        //Creamos un post y lo guardamos
        $this->createPost();

        //Obtenemos la ruta create con el titulo editar post
        $this->get('post/1/edit')
        ->assertStatus(200)
        ->assertSee('Editar Post');
    }

    /** @test */
    public function user_can_see_edit_form()
    {
        //Creamos un post y lo guardamos
        $this->createPost();

        //Para ver si vemos el usuario
        $this->get('/post/1/edit')
            ->assertSee('Formulario para Editar un Post')
            ->assertSee('Título del Post')
            ->assertSee('Descripción')
            ->assertSee('Categoría a la que pertenece');
    }

    /** @test */
    public function a_post_can_be_edited_and_updated()
    {
        $this->withoutExceptionHandling();
        //Creamos un post y lo guardamos 
        $this->createPost();

        //Hacemos una llamada HTTP enviando los datos editados 
        //a la ruta que actualiza los post
        $this->patch('/post/1/update', [
            'title' => 'Test TitleEdit',
            'description' => 'Test DescriptionEdit',
            'category_id' => '1',
            'user_id' => '1'
        ]);

        //Obtenemos el post, ya editado
        $post = Post::first();
        //Comprobamos los datos si son los que hemos introducido
        $this->assertEquals($post->title, 'Test TitleEdit');
        $this->assertEquals($post->description, 'Test DescriptionEdit');
        $this->assertEquals($post->category_id, 1);
    }

        /** @test */
        public function a_post_can_be_deleted()
        {
            $this->withoutExceptionHandling();
            //Creamos un post y lo guardamos 
            $this->createPost();
    
            //Hacemos una llamada HTTP enviando los datos editados 
            //a la ruta que actualiza los post
            $this->delete('/post/1/delete');
    
            //Para comprobar si se ha borrado
            $this->assertDatabaseCount('posts', 0);
        }
}
