<?php

use App\Repositories\CategoryRepository;
use App\Services\CategoryService;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryServiceTest extends TestCase
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
     * @group category
     */
    public function testAll()
    {
        $repository = $this->initMock(CategoryRepository::class);
        $repository->shouldReceive('all')->once();

        $service = new CategoryService($repository);

        $service->all();
    }

    /**
     * @test
     * @group category
     */
    public function testCreate()
    {
        $this->loginFakeUser();

        $service = app(CategoryService::class);

        $service->create(['name' => 'test', 'description' => 'test2']);

        $this->seeInDatabase('categories', [
            'name' => 'test', 'description' => 'test2', 'user_id' => auth()->user()->id,
        ]);
    }

    /**
     * @test
     * @group category
     */
    public function testShow()
    {
        $repository = $this->initMock(CategoryRepository::class);
        $repository->shouldReceive('findOrFail')->once();

        $service = new CategoryService($repository);

        $service->findOrFail(1);
    }

    /**
     * @test
     * @group category
     */
    public function testUpdate()
    {
        $this->loginFakeUser();

        factory(\App\Category::class)->create();

        $service = app(CategoryService::class);

        $service->update(1, [
            'name' => 'updated',
            'description' => 'updated'
        ]);

        $this->seeInDatabase('categories', [
            'name' => 'updated',
            'description' => 'updated',
            'user_id' => auth()->user()->id,
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

        $service = new CategoryService($repository);

        $service->destroy(1);
    }
}
