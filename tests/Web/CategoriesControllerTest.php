<?php

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoriesControllerTest extends TestCase
{
    use DatabaseMigrations, WithoutMiddleware;

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
        $this->visit(route('categories.create'))->assertResponseStatus(200);
    }

    /**
     * @test
     * @group category
     */
    public function testStore()
    {
        $this->loginFakeUser();

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
        $this->loginFakeUser();

        factory(\App\Category::class)->create();

        $this->visit(route('categories.show', 1))->see('movies');
    }

    /**
     * @test
     * @group category
     */
    public function testEdit()
    {
        $this->loginFakeUser();

        factory(\App\Category::class)->create();

        $this->visit(route('categories.edit', 1))->see('movies');
    }

    /**
     * @test
     * @group category
     */
    public function testUpdate()
    {
        $this->loginFakeUser();

        factory(\App\Category::class)->create();

        $this->call('put', route('categories.update', 1), [
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
        $this->loginFakeUser();

        factory(\App\Category::class)->create();

        $this->call('delete', route('categories.destroy', 1));

        $this->assertResponseStatus(302);
    }

    /**
     * @test
     * @group category
     */
    public function products()
    {
        $category = factory(\App\Category::class)->create();

        factory(\App\Product::class)->create([
            'category_id' => $category->id,
            'name' => 'Product1',
        ]);

        factory(\App\Product::class)->create([
            'category_id' => $category->id,
            'name' => 'Product2',
        ]);

        $this->visit(route('categories.show', 1))->see('Product1')->see('Product2');
    }
}
