<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsersControllerTest extends TestCase
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
    public function index()
    {
        factory(\App\User::class)->create([
            'name' => 'yish2',
        ]);
        factory(\App\User::class)->create([
            'name' => 'yish',
        ]);

        $this->visit(route('users.index'))->see('yish')->see('yish2');
    }

    /**
     * @test
     * @group user
     * @param $id
     */
    public function show()
    {
        factory(\App\User::class)->create([
            'name' => 'yish',
        ]);

        $this->visit(route('users.show', 1))->see('yish');
    }
    /**
     * @test
     * @group user
     */
    public function edit()
    {
        factory(\App\User::class)->create([
            'name' => 'yish',
        ]);

        $this->visit(route('users.edit', 1))->see('yish');
    }
    /**
     * @test
     * @group user
     */
    public function update()
    {
        factory(\App\User::class)->create();

        $this->call('put', route('users.update', 1), [
            'name' => 'updated!',
            'description' => 'this is travel, updated!'
        ]);

        $this->assertResponseStatus(302);
    }
}
