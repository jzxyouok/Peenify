<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShowBookmarksTest extends TestCase
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
    public function showBookmarks()
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

        $this->visit(route('users.bookmarks', auth()->user()->id))->see($product->name);
    }
}
