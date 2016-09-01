<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EmojissControllerTest extends TestCase
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
     * @group emoji
     */
    public function syncEmojiByAuth()
    {
        $this->loginFakeUser();

        $product = factory(\App\Product::class)->create();

        $this->call('post', route('emojis.sync', [
            'emojiable_type' => 'product',
            'emojiable_id' => $product->id,
            'type' => 'like'
        ]));

        $this->assertResponseStatus(302);
    }

    /**
     * @test
     * @group emoji
     */
    public function getEmojiedList()
    {
        $this->loginFakeUser();

        $product = factory(\App\Product::class)->create();
        $product2 = factory(\App\Product::class)->create();

        $this->call('post', route('emojis.sync', [
            'emojiable_type' => 'product',
            'emojiable_id' => $product->id,
            'type' => 'like'
        ]));

        $this->call('post', route('emojis.sync', [
            'emojiable_type' => 'product',
            'emojiable_id' => $product2->id,
            'type' => 'normal'
        ]));

        $this->visit(route('users.emojis', auth()->user()->id))->see($product->name)->see($product2->name);
    }
}
