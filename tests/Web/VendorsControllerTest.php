<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VendorsControllerTest extends TestCase
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
     * @group vendor
     */
    public function testIndex()
    {
        $vendor = factory(\App\Vendor::class)->create();
        $vendor2 = factory(\App\Vendor::class)->create([
            'name' => 'yish',
        ]);

        $this->visit(route('vendors.index'))->see($vendor->name)->see($vendor2->name);
    }

    /**
     * @test
     * @group vendor
     */
    public function testCreate()
    {
        $this->loginFakeUser();

        $this->beAdmin();

        $this->visit(route('vendors.create'))
            ->see('Create Vendor')
            ->see('create');
    }

    /**
     * @test
     * @group vendor
     */
    public function testStore()
    {
        $this->loginFakeUser();

        $this->beAdmin();

        $this->call('post', route('vendors.store'), [
            'user_id' => auth()->user()->id,
            'name' => 'travel',
            'description' => 'this is travel',
            'agent' => 'TW'
        ]);

        $this->assertResponseStatus(302);
    }

    /**
     * @test
     * @group vendor
     */
    public function testShow()
    {
        $this->loginFakeUser();

        $vendor = factory(\App\Vendor::class)->create();

        $this->visit(route('vendors.show', 1))->see($vendor->name);
    }

    /**
     * @test
     * @group vendor
     */
    public function testEdit()
    {
        $this->loginFakeUser();

        $this->beAdmin();

        $vendor = factory(\App\Vendor::class)->create();

        $this->visit(route('vendors.edit', 1))->see($vendor->name);
    }

    /**
     * @test
     * @group vendor
     */
    public function testUpdate()
    {
        $this->loginFakeUser();

        $this->beAdmin();

        factory(\App\Vendor::class)->create();

        $this->call('put', route('vendors.update', 1), [
            'name' => 'updated!',
            'description' => 'this is travel, updated!'
        ]);

        $this->assertResponseStatus(302);
    }

    /**
     * @test
     * @group vendor
     */
    public function testDestroy()
    {
        $this->loginFakeUser();

        $this->beAdmin();

        factory(\App\Vendor::class)->create();

        $this->call('delete', route('vendors.destroy', 1));

        $this->assertResponseStatus(302);
    }
}
