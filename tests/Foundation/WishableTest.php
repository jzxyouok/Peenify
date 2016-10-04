<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WishableTest extends TestCase
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
     * @group wishable
     */
    public function wish()
    {
        $this->loginFakeUser();

        $instance = factory(\App\Product::class)->create();

        $instance->wish(auth()->user());

        $this->seeInDatabase('wishes', [
            'wishable_type' => 'product',
            'wishable_id' => $instance->id,
            'user_id' => auth()->user()->id,
        ]);
    }

    /**
     * @test
     * @group wishable
     */
    public function unWish()
    {
        $this->loginFakeUser();

        $instance = factory(\App\Product::class)->create();

        $instance->wish(auth()->user());

        $instance->unWish(auth()->user());

        $this->dontSeeInDatabase('subscribes', [
            'wishable_type' => 'product',
            'wishable_id' => $instance->id,
            'user_id' => auth()->user()->id,
        ]);
    }

    /**
     * @test
     * @group wishable
     */
    public function isWish()
    {
        $this->loginFakeUser();

        $instance = factory(\App\Product::class)->create();

        $instance->wish(auth()->user());

        $result = $instance->isWish(auth()->user());

        $this->assertTrue($result);
    }

    /**
     * @test
     * @group wishable
     */
    public function isWishFalse()
    {
        $this->loginFakeUser();

        $instance = factory(\App\Product::class)->create();

        $instance->wish(new \App\User(['id' => 2, 'name' => 'yish2']));

        $result = $instance->isWish(auth()->user());

        $this->assertFalse($result);
    }
}
