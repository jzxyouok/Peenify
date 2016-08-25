<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryRepositoryTest extends TestCase
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
     * @group category
     */
    public function testUpdate()
    {
        factory(\App\Category::class)->create();

        app(\App\Repositories\CategoryRepository::class)->update(1, [
            'name' => 'updated',
            'description' => 'updated'
        ]);

        $this->seeInDatabase('categories', [
            'name' => 'updated',
            'description' => 'updated'
        ]);
    }
}
