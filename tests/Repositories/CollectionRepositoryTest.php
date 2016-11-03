<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CollectionRepositoryTest extends TestCase
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
    public function paginateSearchResult()
    {
        $collection = factory(\App\Collection::class)->create([
            'name' => 'test collection',
        ]);

        $repository = app(\App\Repositories\CollectionRepository::class);

        $result = $repository->paginateSearchResult('test', 'latest', 12);

        $this->assertEquals($collection->name, $result[0]->name);
    }
}
