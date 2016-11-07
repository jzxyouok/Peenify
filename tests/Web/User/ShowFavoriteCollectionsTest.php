<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShowFavoriteCollectionsTest extends TestCase
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
    public function showFavoritesCollections()
    {
        $this->loginFakeUser();

        $collection = factory(\App\Collection::class)->create();
        $collection1 = factory(\App\Collection::class)->create();
        $collection2 = factory(\App\Collection::class)->create();

        factory(\App\Favorite::class)->create([
            'favorable_id' => $collection->id,
            'favorable_type' => 'collection',
            'user_id' => auth()->user()->id,
        ]);

        factory(\App\Favorite::class)->create([
            'favorable_id' => $collection1->id,
            'favorable_type' => 'collection',
            'user_id' => auth()->user()->id,
        ]);

        factory(\App\Favorite::class)->create([
            'favorable_id' => $collection2->id,
            'favorable_type' => 'collection',
            'user_id' => auth()->user()->id,
        ]);

        $this->visit(route('users.favorites.collections', auth()->user()->id))->see($collection->name);
    }
}
