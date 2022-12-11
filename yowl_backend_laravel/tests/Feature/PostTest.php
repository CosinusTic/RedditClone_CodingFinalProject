<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddPostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_add_post()
    {
        $response = $this->postJson('/api/AddPost', [
            'author_id' => '1',
            'description' => 'unit testing test', 
            'image_url' => 'https://picsum.photos/id/237/536/354',
            'category_id' => '4'
        ]);

        $response->assertStatus(200);
    }

    public function testRegiser()
    {
        $response = $this->postJson('/api/AddUser', [
            'username' => 'TestUnitaire',
            'email' => 'test@unit.fr', 
            'password' => '123',
            'age' => '54'
        ]);
        $response->assertStatus(200);
    }

    public function testUsers()
    {
        $response = $this->get("/api/users");
        $response->assertStatus(200);
    }

    public function testCreateCategory()
    {
        $response = $this->postJson("/api/AddCategory");
        $response->assertStatus(200);
    }

    public function testPosts()
    {
        $response = $this->get("/api/posts");
        $response->assertStatus(200);
    }

    // DB::table('users')->insert([
    //         'username' => 'adrien',
    //         'email' => 'adrien@mail.com',
    //         'password' => '123',
    //         'age' => '18'
    //     ]);

    
}
