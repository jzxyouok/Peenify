<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BookmarkableTest extends TestCase
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
     * @group bookmarkable
     */
    public function bookmark()
    {
        $this->loginFakeUser();

        $instance = factory(\App\Product::class)->create();

        $instance->bookmark(auth()->user());

        $this->seeInDatabase('bookmarks', [
            'bookmarkable_type' => 'product',
            'bookmarkable_id' => $instance->id,
            'user_id' => auth()->user()->id,
        ]);
    }

    /**
     * @test
     * @group bookmarkable
     */
    public function removeBookmark()
    {
        $this->loginFakeUser();

        $instance = factory(\App\Product::class)->create();

        $instance->bookmark(auth()->user());

        $instance->removeBookmark(auth()->user());

        $this->dontSeeInDatabase('bookmarks', [
            'bookmarkable_type' => 'product',
            'bookmarkable_id' => $instance->id,
            'user_id' => auth()->user()->id,
        ]);
    }

    /**
     * @test
     * @group bookmarkable
     */
    public function isBookmark()
    {
        $this->loginFakeUser();

        $instance = factory(\App\Product::class)->create();

        $instance->bookmark(auth()->user());

        $result = $instance->isBookmark(auth()->user());

        $this->assertTrue($result);
    }

    /**
     * @test
     * @group bookmarkable
     */
    public function isBookmarkFalse()
    {
        $this->loginFakeUser();

        $instance = factory(\App\Product::class)->create();

        $instance->bookmark(new \App\User(['id' => 2, 'name' => 'yish2']));

        $result = $instance->isBookmark(auth()->user());

        $this->assertFalse($result);
    }
}
