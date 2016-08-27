<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductsControllerTest extends TestCase
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
     * @group product
     */
    public function testIndex()
    {
        factory(\App\Product::class)->create();
        factory(\App\Product::class)->create([
            'name' => 'world of warcraft',
            'description' => 'this is a amazing game'
        ]);

        $this->visit(route('products.index'))->see('world of warcraft')->see('diablo3');
    }

    /**
     * @test
     * @group product
     */
    public function testCreate()
    {
        $this->visit(route('products.create'))
            ->see('Create Product')
            ->see('create');
    }

    /**
     * @test
     * @group product
     */
    public function testStore()
    {
        $this->call('post', route('products.store'), [
            'name' => 'world of warcraft',
            'description' => 'this is warcraft',
            'cover' => $this->fakeUpload(),
        ]);

        $this->assertResponseStatus(302);
    }

    /**
     * @test
     * @group product
     */
    public function testShow()
    {
        factory(\App\Product::class)->create();

        $this->visit(route('products.show', 1))->see('diablo3');
    }

    /**
     * @test
     * @group product
     */
    public function testEdit()
    {
        factory(\App\Product::class)->create();

        $this->visit(route('products.edit', 1))->see('diablo3');
    }

    /**
     * @test
     * @group product
     */
    public function testUpdate()
    {
        factory(\App\Product::class)->create();

        $this->call('put', route('products.update', 1), [
            'name' => 'updated!',
            'description' => 'this is travel, updated!'
        ]);

        $this->assertResponseStatus(302);
    }

    /**
     * @test
     * @group product
     */
    public function testDestroy()
    {
        factory(\App\Product::class)->create();

        $this->call('delete', route('products.destroy', 1));

        $this->assertResponseStatus(302);
    }
}
