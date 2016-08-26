<?php

use Illuminate\Http\UploadedFile;

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * 初始化mock物件
     *
     * @param string $class
     * @return \Mockery\MockInterface
     */
    public function initMock($class)
    {
        $mock = Mockery::mock($class);
        $this->app->instance($class, $mock);

        return $mock;
    }

    public function fakeUpload()
    {
        return new UploadedFile(storage_path('app/test.png'), 'test.png');
    }
}
