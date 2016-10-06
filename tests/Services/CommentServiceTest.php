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
    public function testEdit()
    {
        $this->loginFakeUser();

        $comment = factory(\App\Comment::class)->create([
            'user_id' => auth()->user()->id,
        ]);

        $service = app(\App\Services\CommentService::class);

        $result = $service->findOrFail($comment->id);

        $this->assertEquals($result->id, $comment->id);
    }

    /**
     * @test
     * @group comment
     */
    public function testEditWithFalse()
    {
        $this->loginFakeUser();

        $comment = factory(\App\Comment::class)->create();

        $service = app(\App\Services\CommentService::class);

        $result = $service->findOrFail($comment->id);

        $this->assertFalse($result);
    }

    /**
     * @test
     * @group comment
     */
    public function testUpdate()
    {
        $this->loginFakeUser();

        $comment = factory(\App\Comment::class)->create([
            'user_id' => auth()->user()->id,
        ]);

        $service = app(\App\Services\CommentService::class);

        $result = $service->update($comment->id, [
            'description' => 'updated'
        ]);

        $this->assertTrue($result);
    }

    /**
     * @test
     * @group comment
     */
    public function testUpdateWithFalse()
    {
        $this->loginFakeUser();

        $comment = factory(\App\Comment::class)->create();

        $service = app(\App\Services\CommentService::class);

        $result = $service->update($comment->id, [
            'description' => 'updated'
        ]);

        $this->assertFalse($result);
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
