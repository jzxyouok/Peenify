<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShowSubscribedTest extends TestCase
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
    public function ShowSubscribed()
    {
        $this->loginFakeUser();
        $user = factory(\App\User::class)->create();
        $user->subscribe(auth()->user());

        $this->visit(route('subscribes.subscribed', ['type' => 'user', 'id' => auth()->user()->id]))->see($user->name);
    }
}
