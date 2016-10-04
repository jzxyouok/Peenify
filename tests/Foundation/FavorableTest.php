<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FavorableTest extends TestCase
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
     * @group favorable
     */
    public function favorite()
    {
        $this->loginFakeUser();

        $instance = factory(\App\Product::class)->create();

        $instance->favorite(auth()->user());

        $this->seeInDatabase('favorites', [
            'favorable_type' => 'product',
            'favorable_id' => $instance->id,
            'user_id' => auth()->user()->id,
        ]);
    }

    /**
     * @test
     * @group favorable
     */
    public function unFavorite()
    {
        $this->loginFakeUser();

        $instance = factory(\App\Product::class)->create();

        $instance->favorite(auth()->user());

        $instance->unFavorite(auth()->user());

        $this->dontSeeInDatabase('favorites', [
            'favorable_type' => 'product',
            'favorable_id' => $instance->id,
            'user_id' => auth()->user()->id,
        ]);
    }

    /**
     * @test
     * @group favorable
     */
    public function isFavorite()
    {
        $this->loginFakeUser();

        $instance = factory(\App\Product::class)->create();

        $instance->favorite(auth()->user());

        $result = $instance->isFavorite(auth()->user());

        $this->assertTrue($result);
    }

    /**
     * @test
     * @group favorable
     */
    public function isFavoriteFalse()
    {
        $this->loginFakeUser();

        $instance = factory(\App\Product::class)->create();

        $instance->favorite(new \App\User(['id' => 2, 'name' => 'yish2']));

        $result = $instance->isFavorite(auth()->user());

        $this->assertFalse($result);
    }
}
