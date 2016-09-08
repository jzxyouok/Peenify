<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TagServiceTest extends TestCase
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
     * @group tag
     */
    public function getLikeTagsByName()
    {
        factory(\App\Tag::class)->create([
            'name' => 'AAAAAA',
            'namespace' => 'product',
            'slug' => base64_encode('AAAAAA')
        ]);

        factory(\App\Tag::class)->create([
            'name' => 'AAAABBBBBBAA',
            'namespace' => 'product',
            'slug' => base64_encode('AAAABBBBBBAA')
        ]);

        factory(\App\Tag::class)->create([
            'name' => 'CCCCCCBBBBBB',
            'namespace' => 'product',
            'slug' => base64_encode('CCCCCCBBBBBB')
        ]);

        $service = app(\App\Services\TagService::class);

        $result = $service->getLikeTagsByName('B');

        $this->assertCount(2, $result);
    }
}
