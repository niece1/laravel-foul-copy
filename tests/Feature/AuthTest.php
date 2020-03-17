<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function test_login_redirects_successfully()
    {
        factory(User::class)->create([
            'email'=>'admin@admin.com',
            'password'=>bcrypt('password123'),
        ]);

        $response=$this->get('/login', ['email'=>'admin@admin.com', 'password'=>'password123']);

        $response->assertStatus(302);
        $response->assertRedirect('/');
    } 

    public function test_authenticated_user_can_access_products_table()
    {
        $user=factory(User::class)->create([
            'email'=>'admin@admin.com',
            'password'=>bcrypt('password123'),
        ]);

        $response=$this->actingAs($user)->get('/books');

        $response->assertStatus(200);
    } 

    public function test_unauthenticated_user_cannot_access_products_table()
    {
        
        $response=$this->get('/books');

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }    
}
