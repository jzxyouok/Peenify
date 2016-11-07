<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShowFavoriteProductsTest extends TestCase
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
     * @group favorite
     */
    public function showFavoritesProducts()
    {
        $this->loginFakeUser();

        $product = factory(\App\Product::class)->create();
        $product1 = factory(\App\Product::class)->create();
        $product2 = factory(\App\Product::class)->create();

        factory(\App\Favorite::class)->create([
            'favorable_id' => $product->id,
            'favorable_type' => 'product',
            'user_id' => auth()->user()->id,
        ]);

        factory(\App\Favorite::class)->create([
            'favorable_id' => $product1->id,
            'favorable_type' => 'product',
            'user_id' => auth()->user()->id,
        ]);

        factory(\App\Favorite::class)->create([
            'favorable_id' => $product2->id,
            'favorable_type' => 'product',
            'user_id' => auth()->user()->id,
        ]);

        $this->visit(route('users.favorites.products', auth()->user()->id))->see($product->name);
    }
}
