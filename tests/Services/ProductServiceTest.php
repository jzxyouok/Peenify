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

        $category = factory(\App\Category::class)->create();
        $author = factory(\App\Author::class)->create();
        $actor = factory(\App\Actor::class)->create();

        $service = app(\App\Services\ProductService::class);

        $service->create([
            'category_id' => $category->id,
            'name' => 'test',
            'description' => 'test2',
            'cover' => '1234.png',
            'tags' => "1,2,3,我是中文",
            'authors' => [$author->id],
            'actors' => [$actor->id],
        ]);

        $this->seeInDatabase('products', [
            'category_id' => $category->id,
            'name' => 'test',
            'description' => 'test2',
            'user_id' => auth()->user()->id,
        ]);

        $this->seeInDatabase('author_product', [
            'product_id' => 1,
            'author_id' => 1,
        ]);

        $this->seeInDatabase('actor_product', [
            'product_id' => 1,
            'actor_id' => 1,
        ]);

        $this->seeInDatabase('tags', [
            'name' => 1
        ]);
        $this->seeInDatabase('tags', [
            'name' => 2
        ]);
        $this->seeInDatabase('tags', [
            'name' => 3
        ]);
        $this->seeInDatabase('tags', [
            'name' => '我是中文',
            'slug' => base64_encode('我是中文'),
        ]);

        $this->seeInDatabase('tagged', [
            'taggable_type' => 'product',
            'taggable_id' => 1,
            'tag_id' => 1
        ]);

        $this->seeInDatabase('tagged', [
            'taggable_type' => 'product',
            'taggable_id' => 1,
            'tag_id' => 2
        ]);

        $this->seeInDatabase('tagged', [
            'taggable_type' => 'product',
            'taggable_id' => 1,
            'tag_id' => 3
        ]);

        $this->seeInDatabase('tagged', [
            'taggable_type' => 'product',
            'taggable_id' => 1,
            'tag_id' => 4
        ]);
    }

    /**
     * @test
     * @group product
     */
    public function testCreateNoCover()
    {
        $this->loginFakeUser();
        $category = factory(\App\Category::class)->create();

        $service = app(\App\Services\ProductService::class);

        $service->create([
            'category_id' => $category->id,
            'name' => 'test',
            'description' => 'test2',
            'cover' => null,
            'tags' => "1,2,3,我是中文",
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
            'description' => 'updated',
            'tags' => [1, 2, 3, 4]
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
