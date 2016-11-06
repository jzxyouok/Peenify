<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShowSubscriberTest extends TestCase
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
     * @group user
     */
    public function ShowSubscriber()
    {
        $this->loginFakeUser();
        $user = factory(\App\User::class)->create();
        $user->subscribe(auth()->user());

        $this->visit(route('subscribes.subscribers', ['type' => 'user', 'id' => $user->id]))->see(auth()->user()->name);
    }
}
