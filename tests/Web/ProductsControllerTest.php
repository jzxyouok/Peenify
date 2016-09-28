<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductsControllerTest extends TestCase
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
     * @group product
     */
    public function testIndex()
    {
        factory(\App\Product::class)->create();
        factory(\App\Product::class)->create([
            'name' => 'world of warcraft',
            'description' => 'this is a amazing game'
        ]);

        $this->visit(route('products.index'))->see('world of warcraft')->see('diablo3');
    }

    /**
     * @test
     * @group product
     */
    public function testCreate()
    {
        $this->loginFakeUser();

        $this->visit(route('products.create'))->assertResponseStatus(200);
    }

    /**
     * @test
     * @group product
     */
    public function testStore()
    {
        $this->loginFakeUser();

        $category = factory(\App\Category::class)->create();

        $this->call('post', route('products.store'), [
            'category_id' => $category->id,
            'name' => 'world of warcraft',
            'description' => 'this is warcraft',
            'cover' => $this->fakeUpload(),
            'site' => 'http://www.yahoo.com.tw',
            'tags' => [1,2,3,4],
        ]);

        $this->assertResponseStatus(302);
    }

    /**
     * @test
     * @group product
     */
    public function testShow()
    {
        $this->loginFakeUser();

        $product = factory(\App\Product::class)->create();

        factory(\App\Comment::class)->create([
            'commentable_type' => 'product',
            'commentable_id' => $product->id,
            'description' => 'hihi'
        ]);

        factory(\App\Comment::class)->create([
            'commentable_type' => 'product',
            'commentable_id' => $product->id,
            'description' => 'hihi2'
        ]);

        $this->visit(route('products.show', 1))->see('diablo3')->see('hihi')->see('hihi2');
    }

    /**
     * @test
     * @group product
     */
    public function testEdit()
    {
        $this->loginFakeUser();

        $product = factory(\App\Product::class)->create();

        $this->visit(route('products.edit', $product->id))->see('diablo3');
    }

    /**
     * @test
     * @group product
     */
    public function testUpdate()
    {
        $this->loginFakeUser();

        factory(\App\Product::class)->create();

        $this->call('put', route('products.update', 1), [
            'name' => 'updated!',
            'description' => 'this is travel, updated!'
        ]);

        $this->assertResponseStatus(302);
    }

    /**
     * @test
     * @group product
     */
    public function testDestroy()
    {
        $this->loginFakeUser();

        factory(\App\Product::class)->create();

        $this->call('delete', route('products.destroy', 1));

        $this->assertResponseStatus(302);
    }
}
