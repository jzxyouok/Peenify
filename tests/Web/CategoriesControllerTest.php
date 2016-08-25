<?php

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoriesControllerTest extends TestCase
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
     * @group category
     */
    public function testIndex()
    {
        factory(\App\Category::class)->create();
        factory(\App\Category::class)->create([
            'name' => 'games',
            'description' => 'this is a game'
        ]);

        $this->visit(route('categories.index'))->see('movies')->see('games');
    }

    /**
     * @test
     * @group category
     */
    public function testCreate()
    {
        $this->visit(route('categories.create'))
            ->see('Create Category')
            ->see('create');
    }

    /**
     * @test
     * @group category
     */
    public function testStore()
    {
        $this->call('post', route('categories.store'), [
            'name' => 'travel',
            'description' => 'this is travel'
        ]);

        $this->assertResponseStatus(302);
    }

    /**
     * @test
     * @group category
     */
    public function testShow()
    {
        factory(\App\Category::class)->create();

        $this->visit(route('categories.show', 1))->see('movies');
    }

    /**
     * @test
     * @group category
     */
    public function testEdit()
    {
        factory(\App\Category::class)->create();

        $this->visit(route('categories.edit', 1))->see('movies');
    }

    /**
     * @test
     * @group category
     */
    public function testUpdate()
    {
        factory(\App\Category::class)->create();

        $this->call('put', route('categories.show', 1), [
            'name' => 'updated!',
            'description' => 'this is travel, updated!'
        ]);

        $this->assertResponseStatus(302);
    }

    /**
     * @test
     * @group category
     */
    public function testDestroy()
    {
        factory(\App\Category::class)->create();

        $this->call('delete', route('categories.destroy', 1));

        $this->assertResponseStatus(302);
    }
}
