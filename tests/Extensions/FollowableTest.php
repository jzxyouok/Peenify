<?php

use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FollowableTest extends TestCase
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
     * @group followable
     */
    public function createFollow()
    {
        $this->loginFakeUser();

        $user = factory(\App\User::class)->create();

        app(User::class)->createFollow(User::find($user->id), ['user_id' => auth()->user()->id]);

        $this->seeInDatabase('follows', [
            'followable_type' => 'user',
            'followable_id' => $user->id,
            'user_id' => auth()->user()->id,
        ]);
    }

    /**
     * @test
     * @group followable
     */
    public function deleteFollow()
    {
        $this->loginFakeUser();

        $user = factory(\App\User::class)->create();

        app(User::class)->createFollow(User::find($user->id), ['user_id' => auth()->user()->id]);

        app(User::class)->deleteFollow(User::find($user->id), ['user_id' => auth()->user()->id]);

        $this->dontSeeInDatabase('follows', [
            'followable_type' => 'user',
            'followable_id' => $user->id,
            'user_id' => auth()->user()->id,
        ]);
    }

    /**
     * @test
     * @group followable
     */
    public function isExistFollow()
    {
        $this->loginFakeUser();

        $user = factory(\App\User::class)->create();

        app(User::class)->createFollow(User::find($user->id), ['user_id' => auth()->user()->id]);

        $result = app(User::class)->isExistFollow(User::find($user->id), ['user_id' => auth()->user()->id]);

        $this->assertEquals(1, $result);
    }

    /**
     * @test
     * @group followable
     */
    public function syncFollowWithCreate()
    {
        $this->loginFakeUser();

        $user = factory(\App\User::class)->create();

        app(User::class)->syncFollow($user->id, ['user_id' => auth()->user()->id]);

        $this->seeInDatabase('follows', [
            'followable_type' => 'user',
            'followable_id' => $user->id,
            'user_id' => auth()->user()->id,
        ]);
    }

    /**
     * @test
     * @group followable
     */
    public function syncEmojiWithDelete()
    {
        $this->loginFakeUser();

        $user = factory(\App\User::class)->create();

        app(User::class)->createFollow(User::find($user->id), ['user_id' => auth()->user()->id]);

        app(User::class)->syncFollow($user->id, ['user_id' => auth()->user()->id]);

        $this->dontSeeInDatabase('follows', [
            'followable_type' => 'user',
            'followable_id' => $user->id,
            'user_id' => auth()->user()->id,
        ]);
    }
}
