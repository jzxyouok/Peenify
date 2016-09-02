<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WishesControllerTest extends TestCase
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
    public function store()
    {
        $this->loginFakeUser();

        $product = factory(\App\Product::class)->create();

        $this->call('post', route('wishes.store', $product->id));

        $this->assertResponseStatus(302);
    }

    /**
     * @test
     * @group wish
     */
    public function show()
    {
        $this->loginFakeUser();

        $product = factory(\App\Product::class)->create();

        factory(\App\Wish::class)->create([
            'product_id' => $product->id,
            'user_id' => auth()->user()->id,
        ]);

        $this->visit(route('wishes.user', auth()->user()->id))->see($product->name);
    }

    /**
     * @test
     * @group wish
     */
    public function destroy()
    {
        $this->loginFakeUser();

        $product = factory(\App\Product::class)->create();

        $this->call('post', route('wishes.destroy', $product->id));

        $this->assertResponseStatus(302);
    }
}
