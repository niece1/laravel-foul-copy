<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Book;

class BooksTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test **/
    public function test_bookpage_contains_empty_books_table()
    {
       
        $response = $this->get('/books');

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
