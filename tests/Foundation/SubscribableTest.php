<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SubscribableTest extends TestCase
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
     * @group subcribable
     */
    public function subscribe()
    {
        $this->loginFakeUser();

        $instance = factory(\App\Category::class)->create();

        $instance->subscribe(auth()->user());

        $this->seeInDatabase('subscribes', [
            'subscribable_type' => 'category',
            'subscribable_id' => $instance->id,
            'user_id' => auth()->user()->id,
        ]);
    }

    /**
     * @test
     * @group subcribable
     */
    public function describe()
    {
        $this->loginFakeUser();

        $instance = factory(\App\Category::class)->create();

        $instance->subscribe(auth()->user());

        $instance->describe(auth()->user());

        $this->dontSeeInDatabase('subscribes', [
            'subscribable_type' => 'category',
            'subscribable_id' => $instance->id,
            'user_id' => auth()->user()->id,
        ]);
    }

    /**
     * @test
     * @group subcribable
     */
    public function isSubscribe()
    {
        $this->loginFakeUser();

        $instance = factory(\App\Category::class)->create();

        $instance->subscribe(auth()->user());

        $result = $instance->isSubscribe(auth()->user());

        $this->assertTrue($result);
    }

    /**
     * @test
     * @group subcribable
     */
    public function isSubscribeFalse()
    {
        $this->loginFakeUser();

        $instance = factory(\App\Category::class)->create();

        $instance->subscribe(new \App\User(['id' => 2, 'name' => 'yish2']));

        $result = $instance->isSubscribe(auth()->user());

        $this->assertFalse($result);
    }
}
