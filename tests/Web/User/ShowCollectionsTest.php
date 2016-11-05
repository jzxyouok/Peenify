<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShowCollectionsTest extends TestCase
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
    public function showCollections()
    {
        $this->loginFakeUser();

        $collection = factory(\App\Collection::class)->create([
            'user_id' => auth()->user()->id,
        ]);

        $this->visit(route('users.collections', auth()->user()->id))->see($collection->name);
    }
}
