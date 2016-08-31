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
    public function storeWithProduct()
    {
        $this->loginFakeUser();

        $product = factory(\App\Product::class)->create();

        $this->call('post', route('comments.store', ['commentable_type' => 'product',
        'commentable_id' => $product->id]), [
            'description' => 'this is a comment'
        ]);

        $this->assertResponseStatus(302);
    }

    /**
     * @test
     * @group comment
     */
    public function storeWithUser()
    {
        $this->loginFakeUser();

        $user = factory(\App\User::class)->create();

        $this->call('post', route('comments.store', ['commentable_type' => 'user',
            'commentable_id' => $user->id]), [
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
        $product = factory(\App\Product::class)->create();

        factory(\App\Comment::class)->create([
            'commentable_id' => $product->id,
            'user_id' => factory(\App\User::class)->create(),
            'description' => 'hi'
        ]);
        factory(\App\Comment::class)->create([
            'commentable_id' => $product->id,
            'user_id' => factory(\App\User::class)->create(),
            'description' => 'hi 2',
        ]);

        $this->visit(route('products.show', 1))->see('hi')->see('hi 2');
    }

    /**
     * @test
     * @group comment
     */
    public function testEdit()
    {
        $this->loginFakeUser();

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

        $this->call('put', route('comments.update', 1), [
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
