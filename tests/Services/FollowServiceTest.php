<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FollowServiceTest extends TestCase
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
    public function getAllByUser()
    {
        $this->loginFakeUser();

        $category1 = factory(\App\Category::class)->create();
        $category2 = factory(\App\Category::class)->create();

        factory(\App\Follow::class)->create([
            'followable_type' => 'category',
            'followable_id' => $category1->id,
            'user_id' => auth()->user()->id,
        ]);

        factory(\App\Follow::class)->create([
            'followable_type' => 'category',
            'followable_id' => $category2->id,
            'user_id' => auth()->user()->id,
        ]);

        $service = app(\App\Services\FollowService::class);

        $result = $service->getAllByUser(auth()->user()->id);

        $this->assertCount(2, $result);
    }

    /**
     * @test
     * @group follow
     */
    public function getUserByType()
    {
        $this->loginFakeUser();

        $user1 = factory(\App\User::class)->create();
        $user2 = factory(\App\User::class)->create();

        factory(\App\Follow::class)->create([
            'followable_type' => 'user',
            'followable_id' => auth()->user()->id,
            'user_id' => $user1->id,
        ]);

        factory(\App\Follow::class)->create([
            'followable_type' => 'user',
            'followable_id' => auth()->user()->id,
            'user_id' => $user2->id,
        ]);

        $service = app(\App\Services\FollowService::class);

        $result = $service->getUserByType(auth()->user()->id);

        $this->assertCount(2, $result);
    }
}
