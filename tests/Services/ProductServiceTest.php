<?php

use App\Repositories\ProductRepository;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductServiceTest extends TestCase
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
    public function testAll()
    {
        $repository = $this->initMock(ProductRepository::class);
        $repository->shouldReceive('all')->once();

        $service = new \App\Services\ProductService($repository);

        $service->all();
    }

    /**
     * @test
     * @group product
     */
    public function testCreate()
    {
        $repository = $this->initMock(ProductRepository::class);
        $repository->shouldReceive('create')->once();

        $service = new \App\Services\ProductService($repository);

        $service->create(['name' => 'test', 'description' => 'test2']);
    }

    /**
     * @test
     * @group product
     */
    public function testShow()
    {
        $repository = $this->initMock(ProductRepository::class);
        $repository->shouldReceive('findOrFail')->once();

        $service = new \App\Services\ProductService($repository);

        $service->findOrFail(1);
    }

    /**
     * @test
     * @group product
     */
    public function testUpdate()
    {
        $repository = $this->initMock(ProductRepository::class);
        $repository->shouldReceive('update')->once();

        $service = new \App\Services\ProductService($repository);

        $service->update(1, [
            'name' => 'updated',
            'description' => 'updated'
        ]);
    }

    /**
     * @test
     * @group product
     */
    public function testDestroy()
    {
        $repository = $this->initMock(ProductRepository::class);
        $repository->shouldReceive('destroy')->once();

        $service = new \App\Services\ProductService($repository);

        $service->destroy(1);
    }
}
