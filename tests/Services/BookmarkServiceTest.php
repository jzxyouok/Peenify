<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BookmarkServiceTest extends TestCase
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
     * @group bookmark
     */
    public function getPaginationByUser()
    {
        $this->loginFakeUser();

        $product = factory(\App\Product::class)->create();
        $product1 = factory(\App\Product::class)->create();
        $product2 = factory(\App\Product::class)->create();

        factory(\App\Bookmark::class)->create([
            'bookmarkable_id' => $product->id,
            'user_id' => auth()->user()->id,
        ]);

        factory(\App\Bookmark::class)->create([
            'bookmarkable_id' => $product1->id,
            'user_id' => auth()->user()->id,
        ]);

        factory(\App\Bookmark::class)->create([
            'bookmarkable_id' => $product2->id,
            'user_id' => auth()->user()->id,
        ]);

        $service = app(\App\Services\BookmarkService::class);

        $result = $service->getPaginationByUser(auth()->user()->id, 12);

        $this->assertEquals($product->name, $result[0]->bookmarkable->name);
    }
}
