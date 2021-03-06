<?php

use App\Repositories\CollectionRepository;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CollectionServiceTest extends TestCase
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
     * @group collection
     */
    public function testAll()
    {
        $repository = $this->initMock(CollectionRepository::class);
        $repository->shouldReceive('all')->once();

        $service = new \App\Services\CollectionService($repository);

        $service->all();
    }

    /**
     * @test
     * @group collection
     */
    public function testShow()
    {
        $repository = $this->initMock(CollectionRepository::class);
        $repository->shouldReceive('findOrFail')->once();

        $service = new \App\Services\CollectionService($repository);

        $service->findOrFail(1);
    }

    /**
     * @test
     * @group collection
     */
    public function testUpdate()
    {
        $this->loginFakeUser();

        $repository = $this->initMock(CollectionRepository::class);
        $repository->shouldReceive('update')->once();

        $service = new \App\Services\CollectionService($repository);

        $service->update(1, [
            'name' => 'updated',
            'description' => 'updated'
        ]);
    }

    /**
     * @test
     * @group collection
     */
    public function testDestroy()
    {
        $repository = $this->initMock(CollectionRepository::class);
        $repository->shouldReceive('destroy')->once();

        $service = new \App\Services\CollectionService($repository);

        $service->destroy(1);
    }

    /**
     * @test
     * @group collection
     */
    public function getPaginationByUser()
    {
        $this->loginFakeUser();

        $collection = factory(\App\Collection::class)->create([
            'user_id' => auth()->user()->id,
        ]);

        $service = app(\App\Services\CollectionService::class);

        $result = $service->getPaginationByUser(auth()->user()->id, 12);

        $this->assertEquals($collection->name, $result[0]->name);
    }
}
