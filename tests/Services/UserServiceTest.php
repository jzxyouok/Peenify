<?php

use App\Repositories\UserRepository;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserServiceTest extends TestCase
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
     * @group user
     */
    public function testAll()
    {
        $repository = $this->initMock(UserRepository::class);
        $repository->shouldReceive('all')->once();

        $service = new \App\Services\UserService($repository);

        $service->all();
    }

    /**
     * @test
     * @group user
     */
    public function testShow()
    {
        $repository = $this->initMock(UserRepository::class);
        $repository->shouldReceive('findOrFail')->once();

        $service = new \App\Services\UserService($repository);

        $service->findOrFail(1);
    }
}
