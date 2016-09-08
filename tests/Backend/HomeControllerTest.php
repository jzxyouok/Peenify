<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HomeControllerTest extends TestCase
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
     * @group backend
     * @test
     */
    public function index()
    {
        $this->loginFakeUser();

        $role = factory(\App\Role::class)->create();

        DB::table('role_user')->insert([
            'user_id' => auth()->user()->id,
            'role_id' => $role->id,
        ]);

        $this->visit(route('backend.index'))->see('yish')->see('welcome to backend');
    }

    /**
     * @group backend
     * @test
     */
    public function indexNoAuth()
    {
        $this->loginFakeUser();

        $user = factory(\App\User::class)->create();

        $role = factory(\App\Role::class)->create();

        DB::table('role_user')->insert([
            'user_id' => $user->id,
            'role_id' => $role->id,
        ]);

        $this->visit(route('backend.index'))->see('儀表板');

    }
}
