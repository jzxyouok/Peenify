<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RolesControllerTest extends TestCase
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
     * @group role
     */
    public function testIndex()
    {
        $this->loginFakeUser();

        factory(\App\Role::class)->create();

        $this->visit(route('roles.index'))->see('Admin');
    }

    /**
     * @test
     * @group role
     */
    public function testCreate()
    {
        $this->loginFakeUser();

        $this->visit(route('roles.create'))->assertResponseStatus(200);
    }

    /**
     * @test
     * @group role
     */
    public function testStore()
    {
        $this->loginFakeUser();

        $this->call('post', route('roles.store'), [
            'name' => 'Admin',
            'label' => 'this is warcraft',
        ]);

        $this->assertResponseStatus(302);
    }

    /**
     * @test
     * @group role
     */
    public function testShow()
    {
        $this->loginFakeUser();

        factory(\App\Role::class)->create();

        $this->visit(route('roles.show', 1))->see('Admin');
    }

    /**
     * @test
     * @group role
     */
    public function testEdit()
    {
        $this->loginFakeUser();

        $role = factory(\App\Role::class)->create();

        $this->visit(route('roles.edit', $role->id))->see('Admin');
    }

    /**
     * @test
     * @group role
     */
    public function testUpdate()
    {
        $this->loginFakeUser();

        factory(\App\Role::class)->create();

        $this->call('put', route('roles.update', 1), [
            'name' => 'updated!',
            'label' => 'this is travel, updated!'
        ]);

        $this->assertResponseStatus(302);
    }

    /**
     * @test
     * @group role
     */
    public function testDestroy()
    {
        $this->loginFakeUser();

        factory(\App\Role::class)->create();

        $this->call('delete', route('roles.destroy', 1));

        $this->assertResponseStatus(302);
    }
}
