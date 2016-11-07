<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BookmarkSyncRelationsTest extends TestCase
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
    public function syncWithBookmark()
    {
        $this->loginFakeUser();

        $product = factory(\App\Product::class)->create();

        $this->call('post', route('bookmarks.sync', [
            'type' => 'product',
            'id' => $product->id
        ]));

        $this->seeInDatabase('bookmarks', [
            'bookmarkable_type' => 'product',
            'bookmarkable_id' => $product->id,
            'user_id' => auth()->user()->id
        ]);
    }

    /**
     * @test
     * @group bookmark
     */
    public function syncWithRemoveBookmark()
    {
        $this->loginFakeUser();

        $product = factory(\App\Product::class)->create();

        $this->call('post', route('bookmarks.sync', [
            'type' => 'product',
            'id' => $product->id
        ]));

        $this->call('post', route('bookmarks.sync', [
            'type' => 'product',
            'id' => $product->id
        ]));

        $this->dontSeeInDatabase('bookmarks', [
            'bookmarkable_type' => 'product',
            'bookmarkable_id' => $product->id,
            'user_id' => auth()->user()->id
        ]);
    }
}
