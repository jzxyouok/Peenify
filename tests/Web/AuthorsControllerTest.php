<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthorsControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     * @group author
     */
    public function testIndex()
    {
        $author = factory(\App\Author::class)->create();
        $author2 = factory(\App\Author::class)->create([
            'name' => 'yish',
        ]);

        $this->visit(route('authors.index'))->see($author->name)->see($author2->name);
    }

    /**
     * @test
     * @group author
     */
    public function testCreate()
    {
        $this->loginFakeUser();

        $this->visit(route('authors.create'))
            ->see('Create Author')
            ->see('create');
    }

    /**
     * @test
     * @group author
     */
    public function testStore()
    {
        $this->loginFakeUser();

        $this->call('post', route('authors.store'), [
            'user_id' => auth()->user()->id,
            'name' => 'travel',
            'description' => 'this is travel',
            'gender' => 'male',
            'country' => 'TW',
        ]);

        $this->assertResponseStatus(302);
    }

    /**
     * @test
     * @group author
     */
    public function testShow()
    {
        $this->loginFakeUser();

        $author = factory(\App\Author::class)->create();

        $this->visit(route('authors.show', 1))->see($author->name);
    }

    /**
     * @test
     * @group author
     */
    public function testEdit()
    {
        $this->loginFakeUser();

        $author = factory(\App\Author::class)->create();

        $this->visit(route('authors.edit', 1))->see($author->name);
    }

    /**
     * @test
     * @group author
     */
    public function testUpdate()
    {
        $this->loginFakeUser();

        factory(\App\Author::class)->create();

        $this->call('put', route('authors.update', 1), [
            'name' => 'updated!',
            'description' => 'this is travel, updated!'
        ]);

        $this->assertResponseStatus(302);
    }

    /**
     * @test
     * @group author
     */
    public function testDestroy()
    {
        $this->loginFakeUser();

        factory(\App\Author::class)->create();

        $this->call('delete', route('authors.destroy', 1));

        $this->assertResponseStatus(302);
    }
}
