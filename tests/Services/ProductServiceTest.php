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
        $this->loginFakeUser();
        factory(\App\Product::class)->create();
        $category = factory(\App\Category::class)->create();

        $service = app(\App\Services\ProductService::class);

        $service->create([
            'category_id' => $category->id,
            'name' => 'test',
            'description' => 'test2',
            'cover' => $this->fakeUpload(),
        ]);

        $this->seeInDatabase('products', [
            'category_id' => $category->id,
            'name' => 'test',
            'description' => 'test2',
            'user_id' => auth()->user()->id,
        ]);
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
        $this->loginFakeUser();
        factory(\App\Product::class)->create();

        $service = app(\App\Services\ProductService::class);

        $service->update(1, [
            'name' => 'updated',
            'description' => 'updated'
        ]);

        $this->seeInDatabase('products', [
            'name' => 'updated',
            'description' => 'updated',
            'user_id' => auth()->user()->id,
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
