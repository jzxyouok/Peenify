<?php

use App\Repositories\WishlistRepository;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WishlistServiceTest extends TestCase
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
     * @group wishlist
     */
    public function testAll()
    {
        $repository = $this->initMock(WishlistRepository::class);
        $repository->shouldReceive('all')->once();

        $service = new \App\Services\WishlistService($repository);

        $service->all();
    }

    /**
     * @test
     * @group wishlist
     */
    public function testCreate()
    {
        $repository = $this->initMock(WishlistRepository::class);
        $repository->shouldReceive('create')->once();

        $service = new \App\Services\WishlistService($repository);

        $service->create(['name' => 'test', 'description' => 'test2']);
    }

    /**
     * @test
     * @group wishlist
     */
    public function testShow()
    {
        $repository = $this->initMock(WishlistRepository::class);
        $repository->shouldReceive('findOrFail')->once();

        $service = new \App\Services\WishlistService($repository);

        $service->findOrFail(1);
    }

    /**
     * @test
     * @group wishlist
     */
    public function testUpdate()
    {
        $repository = $this->initMock(WishlistRepository::class);
        $repository->shouldReceive('update')->once();

        $service = new \App\Services\WishlistService($repository);

        $service->update(1, [
            'name' => 'updated',
            'description' => 'updated'
        ]);
    }

    /**
     * @test
     * @group wishlist
     */
    public function testDestroy()
    {
        $repository = $this->initMock(WishlistRepository::class);
        $repository->shouldReceive('destroy')->once();

        $service = new \App\Services\WishlistService($repository);

        $service->destroy(1);
    }
}
