<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BooksTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_bookpage_contains_empty_books_table()
    {
       
        $response = $this->get('/books');

        $response->assertStatus(200);

        $response->assertSee('No books found');

    }

    public function test_bookpage_contains_not_empty_books_table()
    {
        if (isset($filterConfig) && isset($filterConfig['show']['all'])) {
        $showAll = true;
        } else {
        $showAll = false;
        }
        $book=Book::create([
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
}
