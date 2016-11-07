<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SubscribeSyncRelationsTest extends TestCase
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
     * @group subscribe
     */
    public function syncWithSubscribe()
    {
        $this->loginFakeUser();

        $user = factory(\App\User::class)->create();

        $this->call('post', route('subscribes.sync', [
            'type' => 'user',
            'id' => $user->id
        ]));

        $this->seeInDatabase('subscribes', [
           'subscribable_type' => 'user',
            'subscribable_id' => $user->id,
            'user_id' => auth()->user()->id
        ]);
    }

    /**
     * @test
     * @group subscribe
     */
    public function syncWithDescribe()
    {
        $this->loginFakeUser();

        $user = factory(\App\User::class)->create();

        $this->call('post', route('subscribes.sync', [
            'type' => 'user',
            'id' => $user->id
        ]));

        $this->call('post', route('subscribes.sync', [
            'type' => 'user',
            'id' => $user->id
        ]));

        $this->dontSeeInDatabase('subscribes', [
            'subscribable_type' => 'user',
            'subscribable_id' => $user->id,
            'user_id' => auth()->user()->id
        ]);
    }
}
