<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ActorsControllerTest extends TestCase
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
     * @test
     * @group actor
     */
    public function testCreate()
    {
        $this->loginFakeUser();

        $this->beAdmin();

        $this->visit(route('actors.create'))->assertResponseStatus(200);
    }

    /**
     * @test
     * @group actor
     */
    public function testStore()
    {
        $this->loginFakeUser();

        $this->beAdmin();

        $this->call('post', route('actors.store'), [
            'user_id' => auth()->user()->id,
            'name' => 'travel',
            'description' => 'this is travel',
            'gender' => 'male',
            'country' => 'TW',
        ]);

        $this->assertResponseStatus(302);
    }

    /**
     * @test
     * @group actor
     */
    public function testShow()
    {
        $this->loginFakeUser();

        $actor = factory(\App\Actor::class)->create();

        $this->visit(route('actors.show', 1))->see($actor->name);
    }

    /**
     * @test
     * @group actor
     */
    public function testEdit()
    {
        $this->loginFakeUser();

        $this->beAdmin();

        $actor = factory(\App\Actor::class)->create();

        $this->visit(route('actors.edit', 1))->see($actor->name);
    }

    /**
     * @test
     * @group actor
     */
    public function testUpdate()
    {
        $this->loginFakeUser();

        $this->beAdmin();

        factory(\App\Actor::class)->create();

        $this->call('put', route('actors.update', 1), [
            'name' => 'updated!',
            'description' => 'this is travel, updated!'
        ]);

        $this->assertResponseStatus(302);
    }

    /**
     * @test
     * @group actor
     */
    public function testDestroy()
    {
        $this->loginFakeUser();

        $this->beAdmin();

        factory(\App\Actor::class)->create();

        $this->call('delete', route('actors.destroy', 1));

        $this->assertResponseStatus(302);
    }
}
