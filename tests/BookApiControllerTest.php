<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Book;

class BookApiControllerTest extends TestCase
{

    public function testIndex()
    {
        $books = factory(App\Book::class, 10)->create();

        $this->get(route('api.books.index'))->seeStatusCode(200);

        foreach ($books as $book){
            $this->get(route('api.books.index'))
                ->seeJson([
                    'title' => $book->title,
                    'author' => $book->author,
                    'genre' => $book->genre,
                    'year' => $book->year
                ]);
        }

    }

    public function testStore()
    {
        $response = $this->call('POST', 'api/books',[
            'title' => 'testTitle',
            'author' => 'testAuthor',
            'genre' => 'testGenre',
            'year' => 2016,
        ]);
        $data = json_decode($response->getContent());
        $this->seeJson([
            'title' => 'testTitle',
            'author' => 'testAuthor',
            'genre' => 'testGenre',
            'year' => 2016,
        ])->seeStatusCode(201);

        $this->seeInDatabase('books', ['id' => $data->id]);
    }

    public function DataProvider_for_testStoreWithBadData() {
        return array(
            [['title' => '', 'author' => 'testAuthor', 'genre' => 'testGenre', 'year' => 2016]],
            [['title' => 'testTitle', 'author' => '', 'genre' => 'testGenre', 'year' => 2016]],
            [['title' => 'testTitle', 'author' => 'testAuthor', 'genre' => '', 'year' => 2016]],
            [['title' => 'testTitle', 'author' => 'testAuthor', 'genre' => 'testGenre', 'year' => '']],
            [['title' => 'testTitle', 'author' => 'testAuthor', 'genre' => 15, 'year' => 2016]],
            [['title' => 'testTitle', 'author' => 'testAuthor', 'genre' => 'testGenre', 'year' => 'string']],
            [['title' => 'testTitle', 'author' => 'testAuthor', 'genre' => 'testGenre', 'year' => 999]],
            [['title' => 'testTitle', 'author' => 'testAuthor', 'genre' => 'testGenre', 'year' => 55555]],

        );
    }
    /**
     * @dataProvider DataProvider_for_testStoreWithBadData
     */
    public function testStoreWithBadData($array)
    {
        $this->call('POST', 'api/books',$array);
        $this->seeStatusCode(422);
        
    }

    public function testShow()
    {
        $book = factory(App\Book::class)->create();

        $this->get(route('api.books.show', ['id' => $book->id]))
            ->seeStatusCode(200)->seeJson([
                'title' => $book->title,
                'author' => $book->author,
                'genre' => $book->genre,
                'year' => (string)$book->year
            ]);

        $this->seeInDatabase('books', ['id' => $book->id]);
    }
    public function testShowWithBadId()
    {
        $this->get(route('api.books.show', ['id' => 9999999999999999]))
            ->seeStatusCode(404);
    }
    
    public function testUpdate()
    {
        $book = factory(App\Book::class)->create();

        $this->put(route('api.books.update', ['id' => $book->id]), [
            'title' => 'updatedTitle',
            'author' => 'updatedAuthor',
            'genre' => 'updatedGenre',
            'year' => 2016
        ])->seeStatusCode(200)->see('Book with ID:' . $book->id . ' successfully updated');
        $this->seeInDatabase('books', [
            'id' => $book->id,
            'title' => 'updatedTitle',
            'genre' => 'updatedGenre',
            'year' => 2016
        ]);
    }
    /**
     * @dataProvider DataProvider_for_testStoreWithBadData
     */
    public function testUpdateWithBadData($array)
    {
        $book = factory(App\Book::class)->create();

        $this->put(route('api.books.update', ['id' => $book->id]), $array)->seeStatusCode(406);
    }
    
    public function testDestroy()
    {
        $book = factory(App\Book::class)->create();
        $this->delete(route('api.books.destroy', ['id' => $book->id]))
            ->seeStatusCode(200)
            ->see('Book with ID:' .$book->id. ' Successfully deleted');
        $this->notSeeInDatabase('books', ['id' => $book->id]);
    }
    public function testDestroyWithBadId()
    {
        $book = factory(App\Book::class)->create();
        $this->delete(route('api.books.destroy', ['id' => ($book->id+1)]))
            ->seeStatusCode(406)
            ->see('ERROR: There is no Book with ID:' . ($book->id+1));
    }

    public function testGiveBack()
    {
        $book = factory(App\Book::class)->create();

        $this->call('GET','api/books/'.$book->id.'/giveback');

        $this->seeStatusCode(200)->see('Book with ID:' .$book->id. ' has given back successfully');
    }
    
    public function testGiveBackWithBadId()
    {
        $book = factory(App\Book::class)->create();

        $this->call('GET','api/books/'.($book->id+99999999).'/giveback');

        $this->seeStatusCode(406)->see('There is no book with id');
    }
}