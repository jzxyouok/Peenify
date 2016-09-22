<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CollectionRepositoryTest extends TestCase
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
    public function attachProduct()
    {
        $product = factory(\App\Product::class)->create();

        $collection = factory(\App\Collection::class)->create();

        $repository = app(\App\Repositories\CollectionRepository::class);

        $repository->attachProduct($collection->id, $product->id);

        $this->seeInDatabase('collection_product', [
            'collection_id' => 1,
            'product_id' => 1,
        ]);
    }
}
