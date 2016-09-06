<?php

use App\Services\WishService;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WishServiceTest extends TestCase
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
     * @group wish
     */
    public function create()
    {
        $this->loginFakeUser();

        $product = factory(\App\Product::class)->create();

        $service = app(WishService::class);

        $service->create($product->id);

        $this->seeInDatabase('wishes', [
           'product_id' => $product->id,
            'user_id' => auth()->user()->id,
        ]);
    }

    /**
     * @test
     * @group wish
     */
    public function destroy()
    {
        $this->loginFakeUser();

        $product = factory(\App\Product::class)->create();

        $service = app(WishService::class);

        $service->destroy($product->id);

        $this->dontSeeInDatabase('wishes', [
            'product_id' => $product->id,
            'user_id' => auth()->user()->id,
        ]);
    }

    public function getWishByProductAndAuth()
    {
        $this->loginFakeUser();

        $product = factory(\App\Product::class)->create();

        $service = app(WishService::class);

        $service->destroy($product->id);

        $this->dontSeeInDatabase('wishes', [
            'product_id' => $product->id,
            'user_id' => auth()->user()->id,
        ]);
    }
}
