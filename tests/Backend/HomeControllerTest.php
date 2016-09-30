<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HomeControllerTest extends TestCase
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
     * @group backend
     * @test
     */
    public function products()
    {
        factory(\App\Product::class)->times(5)->create();

        $this->visit(route('backend.products'))->see(5);
    }
}
