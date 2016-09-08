<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FollowsControllerTest extends TestCase
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
     * @group follow
     */
    public function syncFollowByAuth()
    {
        $this->loginFakeUser();

        $user = factory(\App\User::class)->create();

        $this->call('post', route('follows.sync', [
            'followable_type' => 'user',
            'followable_id' => $user->id,
            'type' => 'like'
        ]));

        $this->assertResponseStatus(200);
    }

    /**
     * @test
     * @group follow
     */
    public function getfollowedList()
    {
        $this->loginFakeUser();

        $user = factory(\App\User::class)->create();
        $user2 = factory(\App\User::class)->create();

        $this->call('post', route('follows.sync', [
            'followable_type' => 'user',
            'followable_id' => $user->id,
            'type' => 'like'
        ]));

        $this->call('post', route('follows.sync', [
            'followable_type' => 'user',
            'followable_id' => $user2->id,
            'type' => 'like'
        ]));

        $this->visit(route('users.follows', auth()->user()->id))->see($user->name)->see($user2->name);
    }
}
