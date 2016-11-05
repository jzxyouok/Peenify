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
        $this->loginFakeUser();

        $this->visit(route('users.edit'))->seeStatusCode(200);
    }

    /**
     * @test
     * @group user
     */
    public function update()
    {
        $this->loginFakeUser();

        $this->call('put', route('users.update'), [
            'name' => 'updated!',
            'description' => 'this is travel, updated!',
        ]);

        $this->assertResponseStatus(302);
    }
}
