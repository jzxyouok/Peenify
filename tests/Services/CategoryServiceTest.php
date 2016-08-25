<?php

use App\Repositories\CategoryRepository;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryServiceTest extends TestCase
{
    use DatabaseMigrations;

    protected $service;

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
     * @group category
     */
    public function testAll()
    {
        $repository = $this->initMock(CategoryRepository::class);
        $repository->shouldReceive('all')->once();

        $service = new \App\Services\CategoryService($repository);

        $service->all();
    }

    /**
     * @test
     * @group category
     */
    public function testCreate()
    {
        $repository = $this->initMock(CategoryRepository::class);
        $repository->shouldReceive('create')->once();

        $service = new \App\Services\CategoryService($repository);

        $service->create(['name' => 'test', 'description' => 'test2']);
    }

    /**
     * @test
     * @group category
     */
    public function testShow()
    {
        $repository = $this->initMock(CategoryRepository::class);
        $repository->shouldReceive('findOrFail')->once();

        $service = new \App\Services\CategoryService($repository);

        $service->findOrFail(1);
    }

    /**
     * @test
     * @group category
     */
    public function testUpdate()
    {
        $repository = $this->initMock(CategoryRepository::class);
        $repository->shouldReceive('update')->once();

        $service = new \App\Services\CategoryService($repository);

        $service->update(1, [
            'name' => 'updated',
            'description' => 'updated'
        ]);
    }

    /**
     * @test
     * @group category
     */
    public function testDestroy()
    {
        $repository = $this->initMock(CategoryRepository::class);
        $repository->shouldReceive('destroy')->once();

        $service = new \App\Services\CategoryService($repository);

        $service->destroy(1);
    }
}
