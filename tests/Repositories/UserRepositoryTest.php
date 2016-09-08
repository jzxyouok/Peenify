<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserRepositoryTest extends TestCase
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
    public function attachRoles()
    {
        factory(\App\Role::class)->create();
        factory(\App\Role::class)->create([
            'name' => 'Elite',
            'description' => '菁英'
        ]);

        $user = factory(\App\User::class)->create();

        $repo = app(\App\Repositories\UserRepository::class);

        $repo->attachRoles($user->id, [1,2]);

        $this->seeInDatabase('role_user', [
            'role_id' => 1,
            'user_id' => 1,
        ]);

        $this->seeInDatabase('role_user', [
            'role_id' => 2,
            'user_id' => 1,
        ]);
    }
}
