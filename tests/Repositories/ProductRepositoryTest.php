<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductRepositoryTest extends TestCase
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
    public function paginateSearchResult()
    {
        $product = factory(\App\Product::class)->create([
            'name' => 'test for 12345',
        ]);

        $repository = app(\App\Repositories\ProductRepository::class);

        $result = $repository->paginateSearchResult('test', 'latest', 12);

        $this->assertEquals($product->name, $result[0]->name);
    }

    /**
     * @test
     * @group product
     */
    public function paginateByCategory()
    {
        $category = factory(\App\Category::class)->create();

        $product = factory(\App\Product::class)->create([
            'name' => 'test for 12345',
            'category_id' => $category->id,
        ]);

        $product1 = factory(\App\Product::class)->create([
            'name' => 'test for 12345',
            'category_id' => $category->id,
        ]);

        $repository = app(\App\Repositories\ProductRepository::class);

        $result = $repository->paginateByCategory($category->id, 12);

        $this->assertEquals($product->name, $result[0]->name);
        $this->assertEquals($product1->name, $result[1]->name);
    }
}
