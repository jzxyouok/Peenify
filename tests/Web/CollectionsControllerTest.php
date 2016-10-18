<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CollectionsControllerTest extends TestCase
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
     * @group collection
     */
    public function testIndex()
    {
        factory(\App\Collection::class)->create([
            'name' => 'my collection',
            'description' => 'this is a game'
        ]);

        $this->visit(route('collections.index'))->see('my collection');
    }

    /**
     * @test
     * @group collection
     */
    public function testCreate()
    {
        $this->visit(route('collections.create'))->assertResponseStatus(200);
    }

    /**
     * @test
     * @group collection
     */
    public function testStore()
    {
        $this->loginFakeUser();

        $this->call('post', route('collections.store'), [
            'name' => 'travel',
            'description' => 'this is travel'
        ]);

        $this->assertResponseStatus(302);
    }

    /**
     * @test
     * @group collection
     */
    public function testShow()
    {
        factory(\App\Collection::class)->create();

        $this->visit(route('collections.show', 1))->see('my collection');
    }

    /**
     * @test
     * @group collection
     */
    public function testEdit()
    {
        factory(\App\Collection::class)->create();

        $this->visit(route('collections.edit', 1))->see('my collection');
    }

    /**
     * @test
     * @group collection
     */
    public function testUpdate()
    {
        $this->loginFakeUser();

        factory(\App\Collection::class)->create();

        $this->call('put', route('collections.update', 1), [
            'name' => 'updated!',
            'description' => 'this is travel, updated!'
        ]);

        $this->assertResponseStatus(302);
    }

    /**
     * @test
     * @group collection
     */
    public function testDestroy()
    {
        factory(\App\Collection::class)->create();

        $this->call('delete', route('collections.destroy', 1));

        $this->assertResponseStatus(302);
    }

    /**
     * @test
     * @group collection
     */
    public function addProductToCollection()
    {
        $product = factory(\App\Product::class)->create();

        $collection = factory(\App\Collection::class)->create();

        $this->call('post', route('collections.storeProduct', $product->id), [
            'collection_id' => $collection->id,
        ]);

        $this->assertResponseStatus(302);
    }
}
