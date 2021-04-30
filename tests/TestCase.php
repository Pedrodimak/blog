<?php

namespace Tests;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * 
     *
     * @return User
     */
    protected function loginTest()
    {
        $usercreated = User::factory()->create();

        $response = $this->post('/login/authenticate', [
            'email' => $usercreated->email,
            'password' => '1234',
        ]);
        
        $userbdd = User::find(1);
        $response->assertSessionHas(1, $userbdd->id);

        return $usercreated;
    }

    /**
     * 
     *
     * @return Post
     */
    protected function createPost()
    {
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
    }
}
