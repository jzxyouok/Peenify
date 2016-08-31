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
     * @group comment
     */
    public function testCreateWithProduct()
    {
        $this->loginFakeUser();
        $product = factory(\App\Product::class)->create();
        $service = app(\App\Services\CommentService::class);

        $service->saveComment('product', $product->id, ['description' => 'test2']);

        $this->seeInDatabase('comments', [
            'commentable_id' => $product->id,
            'commentable_type' => 'product',
            'user_id' => auth()->user()->id,
            'description' => 'test2',
        ]);
    }

    /**
     * @test
     * @group comment
     */
    public function testCreateWithUser()
    {
        $this->loginFakeUser();
        $user = factory(\App\User::class)->create();
        $service = app(\App\Services\CommentService::class);

        $service->saveComment('user', $user->id, ['description' => 'test2']);

        $this->seeInDatabase('comments', [
            'commentable_id' => $user->id,
            'commentable_type' => 'user',
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
