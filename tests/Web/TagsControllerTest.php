<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TagsControllerTest extends TestCase
{
    use DatabaseMigrations, WithoutMiddleware;

    public function setUp()
    {
        parent::setUp();
    }
    public function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @group tag
     * @test
     */
    public function index()
    {
        factory(\App\Tag::class)->create([
            'name' => 'A',
        ]);

        factory(\App\Tag::class)->create([
            'name' => 'B',
        ]);

        factory(\App\Tag::class)->create([
            'name' => 'C',
        ]);

        $this->visit(route('tags.index'))->see('A')->see('B')->see('C');
    }

    /**
     * @group tag
     * @test
     */
    public function show()
    {
        $tag = factory(\App\Tag::class)->create([
            'name' => 'A',
        ]);

        $this->visit(route('tags.show', $tag->id))->see('A');
    }
}
