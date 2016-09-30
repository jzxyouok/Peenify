<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ActorsControllerTest extends TestCase
{
    use DatabaseMigrations, WithoutMiddleware;

    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    /**
     * 不需要登入即可看到
     * @test
     * @group actor
     */
    public function testIndex()
    {
        $actor = factory(\App\Actor::class)->create();
        $actor2 = factory(\App\Actor::class)->create([
            'name' => 'yish',
        ]);

        $this->visit(route('actors.index'))->see($actor->name)->see($actor2->name);
    }

    /**
     * 簡單的表單
     * @test
     * @group actor
     */
    public function testCreate()
    {
        $this->visit(route('actors.create'))->assertResponseStatus(200);
    }

    /**
     * 需要寫入 user_id 誰建立的，所以必須登入
     * @test
     * @group actor
     */
    public function testStore()
    {
        $this->loginFakeUser();

        $this->call('post', route('actors.store'), [
            'name' => 'travel',
            'description' => 'this is travel',
            'gender' => 'male',
            'country' => 'TW',
        ]);

        $this->assertResponseStatus(302);
    }

    /**
     * 不需登入看演員
     * @test
     * @group actor
     */
    public function testShow()
    {
        $actor = factory(\App\Actor::class)->create();

        $this->visit(route('actors.show', 1))->see($actor->name);
    }

    /**
     * 簡單表單
     * @test
     * @group actor
     */
    public function testEdit()
    {
        $actor = factory(\App\Actor::class)->create();

        $this->visit(route('actors.edit', 1))->see($actor->name);
    }

    /**
     * 更新需要 user_id
     * @test
     * @group actor
     */
    public function testUpdate()
    {
        $this->loginFakeUser();

        $actor = factory(\App\Actor::class)->create();

        $this->call('put', route('actors.update', $actor->id), [
            'name' => 'updated!',
            'description' => 'this is travel',
            'gender' => 'male',
            'country' => 'TW',
        ]);

        $this->assertResponseStatus(302);
    }

    /**
     * 刪除
     * @test
     * @group actor
     */
    public function testDestroy()
    {
        factory(\App\Actor::class)->create();

        $this->call('delete', route('actors.destroy', 1));

        $this->assertResponseStatus(302);
    }
}
