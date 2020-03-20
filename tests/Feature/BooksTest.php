<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Book;

class BooksTest extends TestCase
{
    use RefreshDatabase;

    private function create_user()
    {
        return factory(User::class)->create([
            'email'=>'admin@admin.com',
            'password'=>bcrypt('password123'),
        ]);
    }

    private function create_user($is_admin=0)
    {
        return factory(User::class)->create([
            'email'=>($is_admin) ? 'admin@admin.com' :  'user@user.com',
            'password'=>bcrypt('password123'),
            'is_admin'=> $is_admin,
        ]);
    }
    
    //the same as previous, we need delete $user=$this->create_user(); change $response=$this->actingAs($this->user)->get('/books');
    public function setUp(): void
    {
        parent::setUp();
        $this->user=factory(User::class)->create([
            'email'=>'admin@admin.com',
            'password'=>bcrypt('password123'),
        ]);
    }
    
    /** @test **/
    public function test_bookpage_contains_empty_books_table()
    {
       
        $response = $this->get('/books');

        $response->assertStatus(200);

        $response->assertSee('No books found');

    }
    
    //the same as previous yet if auth
    public function test_bookpage_contains_empty_books_table()
    {
        $user=$this->create_user();
       
        $response=$this->actingAs($user)->get('/books');

        $response->assertStatus(200);

        $response->assertSee('No books found');

    }
    
    /** @test **/
    public function test_bookpage_contains_not_empty_books_table()
    {      
        $book = Book::create([
            'name' => 'Another book',
            'price' => 22.99,
        ]);

        $response = $this->get('/books');

        $response->assertStatus(200);

      //  $response->assertSee('No books found');

        $response->assertDontSee('No books found');

      //  $response->assertSee($book->name);
        $view_books=$response->viewData('books');
        $this->assertEquals($book->name, $view_books->first()->name);
    }

    public function test_paginated_books_table_doesnt_show_11th_record()
    {
        $books = factory(Book::class, 11)->create();
        //for($i=0, $i<=11, $i++) {
        //    $book = Book::create([
        //    'name' => 'Book' . $i,
        //    'price' => rand(10, 99)
        //]);
        //}

        $response = $this->get('/books');
        $response->assertDontSee('$book->name');

    }
    // identical to previous test, if you need to override data add ['price'=>99] in create() parameter
    public function test_paginate_books_table_doesnt_show_11th_record()
    {
        $books = factory(Book::class, 11)->create();
        

        $response = $this->get('/books');
        $response->assertDontSee('$book->last()->name');

    }
}
