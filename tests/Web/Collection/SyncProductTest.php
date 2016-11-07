<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SyncProductTest extends TestCase
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
     * @group collection
     */
    public function syncWithAttach()
    {
        $this->loginFakeUser();

        $collection = factory(\App\Collection::class)->create();

        $product = factory(\App\Product::class)->create();

        $this->call('post', route('collections.product', [
            'collection' => $collection->id,
            'id' => $product->id
        ]));

        $this->seeInDatabase('collection_product', [
            'collection_id' => $collection->id,
            'product_id' => $product->id,
        ]);
    }

    /**
     * @test
     * @group collection
     */
    public function syncWithDetach()
    {
        $this->loginFakeUser();

        $collection = factory(\App\Collection::class)->create();

        $product = factory(\App\Product::class)->create();

        $this->call('post', route('collections.product', [
            'collection' => $collection->id,
            'id' => $product->id
        ]));

        $this->call('post', route('collections.product', [
            'collection' => $collection->id,
            'id' => $product->id
        ]));

        $this->dontSeeInDatabase('collection_product', [
            'collection_id' => $collection->id,
            'product_id' => $product->id,
        ]);
    }
}
