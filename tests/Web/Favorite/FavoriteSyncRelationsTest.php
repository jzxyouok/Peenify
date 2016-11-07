<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FavoriteSyncRelationsTest extends TestCase
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
    public function syncWithFavorite()
    {
        $this->loginFakeUser();

        $product = factory(\App\Product::class)->create();

        $this->call('post', route('favorites.sync', [
            'type' => 'product',
            'id' => $product->id
        ]));

        $this->seeInDatabase('favorites', [
            'favorable_type' => 'product',
            'favorable_id' => $product->id,
            'user_id' => auth()->user()->id
        ]);
    }

    /**
     * @test
     * @group favorite
     */
    public function syncWithRemoveFavorite()
    {
        $this->loginFakeUser();

        $product = factory(\App\Product::class)->create();

        $this->call('post', route('favorites.sync', [
            'type' => 'product',
            'id' => $product->id
        ]));

        $this->call('post', route('favorites.sync', [
            'type' => 'product',
            'id' => $product->id
        ]));

        $this->dontSeeInDatabase('favorites', [
            'favorable_type' => 'product',
            'favorable_id' => $product->id,
            'user_id' => auth()->user()->id
        ]);
    }
}
