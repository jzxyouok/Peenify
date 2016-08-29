<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WishlistsControllerTest extends TestCase
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
     * @group wishlist
     */
    public function testIndex()
    {
        factory(\App\Wishlist::class)->create([
            'name' => 'my wishlist',
            'description' => 'this is a game'
        ]);

        $this->visit(route('wishlists.index'))->see('my wishlist');
    }

    /**
     * @test
     * @group wishlist
     */
    public function testCreate()
    {
        $this->visit(route('wishlists.create'))
            ->see('Create Wishlist')
            ->see('create');
    }

    /**
     * @test
     * @group wishlist
     */
    public function testStore()
    {
        $this->loginFakeUser();

        $this->call('post', route('wishlists.store'), [
            'user_id' => auth()->user()->id,
            'name' => 'travel',
            'description' => 'this is travel'
        ]);

        $this->assertResponseStatus(302);
    }

    /**
     * @test
     * @group wishlist
     */
    public function testShow()
    {
        factory(\App\Wishlist::class)->create();

        $this->visit(route('wishlists.show', 1))->see('my wishlist');
    }

    /**
     * @test
     * @group wishlist
     */
    public function testEdit()
    {
        factory(\App\Wishlist::class)->create();

        $this->visit(route('wishlists.edit', 1))->see('my wishlist');
    }

    /**
     * @test
     * @group wishlist
     */
    public function testUpdate()
    {
        factory(\App\Wishlist::class)->create();

        $this->call('put', route('wishlists.show', 1), [
            'name' => 'updated!',
            'description' => 'this is travel, updated!'
        ]);

        $this->assertResponseStatus(302);
    }

    /**
     * @test
     * @group wishlist
     */
    public function testDestroy()
    {
        factory(\App\Wishlist::class)->create();

        $this->call('delete', route('wishlists.destroy', 1));

        $this->assertResponseStatus(302);
    }
}
