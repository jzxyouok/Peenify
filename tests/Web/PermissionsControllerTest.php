<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PermissionsControllerTest extends TestCase
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
     * @test
     * @group permission
     */
    public function testIndex()
    {
        factory(\App\Permission::class)->create();

        $this->visit(route('permissions.index'))->see('edit_all');
    }

    /**
     * @test
     * @group permission
     */
    public function testCreate()
    {
        $this->visit(route('permissions.create'))->assertResponseStatus(200);
    }

    /**
     * @test
     * @group permission
     */
    public function testStore()
    {
        $this->loginFakeUser();

        $this->call('post', route('permissions.store'), [
            'name' => 'editor',
            'label' => 'this is warcraft',
        ]);

        $this->assertResponseStatus(302);
    }

    /**
     * @test
     * @group permission
     */
    public function testShow()
    {
        factory(\App\Permission::class)->create();

        $this->visit(route('permissions.show', 1))->see('edit_all');
    }

    /**
     * @test
     * @group permission
     */
    public function testEdit()
    {
        $permission = factory(\App\Permission::class)->create();

        $this->visit(route('permissions.edit', $permission->id))->see('edit_all');
    }

    /**
     * @test
     * @group permission
     */
    public function testUpdate()
    {
        $this->loginFakeUser();

        factory(\App\Permission::class)->create();

        $this->call('put', route('permissions.update', 1), [
            'name' => 'updated!',
            'label' => 'this is travel, updated!'
        ]);

        $this->assertResponseStatus(302);
    }

    /**
     * @test
     * @group permission
     */
    public function testDestroy()
    {
        factory(\App\Permission::class)->create();

        $this->call('delete', route('permissions.destroy', 1));

        $this->assertResponseStatus(302);
    }
}
