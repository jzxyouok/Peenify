<?php

use App\Repositories\CommentRepository;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CommentServiceTest extends TestCase
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
     * @group comment
     */
    public function testAll()
    {
        $repository = $this->initMock(CommentRepository::class);
        $repository->shouldReceive('all')->once();

        $service = new \App\Services\CommentService($repository);

        $service->all();
    }

    /**
     * @test
     * @group comment1
     */
    public function testCreate()
    {
        $this->loginFakeUser();
        $product = factory(\App\Product::class)->create();
        $service = app(\App\Services\CommentService::class);

        $service->create(['description' => 'test2'], $product->id);

        $this->seeInDatabase('comments', [
            'product_id' => $product->id,
            'user_id' => auth()->user()->id,
            'description' => 'test2',
        ]);
    }

    /**
     * @test
     * @group comment
     */
    public function testShow()
    {
        $repository = $this->initMock(CommentRepository::class);
        $repository->shouldReceive('findOrFail')->once();

        $service = new \App\Services\CommentService($repository);

        $service->findOrFail(1);
    }

    /**
     * @test
     * @group comment
     */
    public function testUpdate()
    {
        $repository = $this->initMock(CommentRepository::class);
        $repository->shouldReceive('update')->once();

        $service = new \App\Services\CommentService($repository);

        $service->update(1, [
            'description' => 'updated'
        ]);
    }

    /**
     * @test
     * @group comment
     */
    public function testDestroy()
    {
        $repository = $this->initMock(CommentRepository::class);
        $repository->shouldReceive('destroy')->once();

        $service = new \App\Services\CommentService($repository);

        $service->destroy(1);
    }
}
