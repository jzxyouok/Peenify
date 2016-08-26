<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CommentsControllerTest extends TestCase
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
    public function testIndex()
    {
        factory(\App\Comment::class)->create();
        factory(\App\Comment::class)->create([
            'description' => 'this is a comment'
        ]);

        $this->visit(route('comments.index'))->see('this is a comment');
    }

    /**
     * @test
     * @group comment
     */
    public function testCreate()
    {
        $this->visit(route('comments.create'))
            ->see('Create Comment')
            ->see('create');
    }

    /**
     * @test
     * @group comment
     */
    public function testStore()
    {
        $this->call('post', route('comments.store'), [
            'description' => 'this is a comment'
        ]);

        $this->assertResponseStatus(302);
    }

    /**
     * @test
     * @group comment
     */
    public function testShow()
    {
        factory(\App\Comment::class)->create();

        $this->visit(route('comments.show', 1))->see(12345);
    }

    /**
     * @test
     * @group comment
     */
    public function testEdit()
    {
        factory(\App\Comment::class)->create();

        $this->visit(route('comments.edit', 1))->see(12345);
    }

    /**
     * @test
     * @group comment
     */
    public function testUpdate()
    {
        factory(\App\Comment::class)->create();

        $this->call('put', route('comments.show', 1), [
            'description' => 'updated!'
        ]);

        $this->assertResponseStatus(302);
    }

    /**
     * @test
     * @group comment
     */
    public function testDestroy()
    {
        factory(\App\Comment::class)->create();

        $this->call('delete', route('comments.destroy', 1));

        $this->assertResponseStatus(302);
    }
}
