<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ConfirmDestroyTest extends TestCase
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
    public function ConfirmDestroy()
    {
        $collection = factory(\App\Collection::class)->create();

        $this->visit(route('collections.confirm.destroy', $collection->id))->seeStatusCode(200);
    }
}
