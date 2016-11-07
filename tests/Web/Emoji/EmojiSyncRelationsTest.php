<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EmojiSyncRelationsTest extends TestCase
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
    public function syncWithEmojiLike()
    {
        $this->loginFakeUser();

        $product = factory(\App\Product::class)->create();

        $this->call('post', route('emojis.sync', [
            'type' => 'product',
            'id' => $product->id,
            'emoji' => 'like'
        ]));

        $this->seeInDatabase('emojis', [
            'emojiable_type' => 'product',
            'emojiable_id' => $product->id,
            'type' => 'like',
            'user_id' => auth()->user()->id
        ]);
    }

    /**
     * @test
     * @group emoji
     */
    public function syncWithRemoveEmojiLike()
    {
        $this->loginFakeUser();

        $product = factory(\App\Product::class)->create();

        $this->call('post', route('emojis.sync', [
            'type' => 'product',
            'id' => $product->id,
            'emoji' => 'like'
        ]));

        $this->call('post', route('emojis.sync', [
            'type' => 'product',
            'id' => $product->id,
            'emoji' => 'like'
        ]));

        $this->dontSeeInDatabase('emojis', [
            'emojiable_type' => 'product',
            'emojiable_id' => $product->id,
            'type' => 'like',
            'user_id' => auth()->user()->id
        ]);
    }

    /**
     * @test
     * @group emoji
     */
    public function syncWithChangeEmoji()
    {
        $this->loginFakeUser();

        $product = factory(\App\Product::class)->create();

        $this->call('post', route('emojis.sync', [
            'type' => 'product',
            'id' => $product->id,
            'emoji' => 'like'
        ]));

        $this->call('post', route('emojis.sync', [
            'type' => 'product',
            'id' => $product->id,
            'emoji' => 'bad'
        ]));

        $this->dontSeeInDatabase('emojis', [
            'emojiable_type' => 'product',
            'emojiable_id' => $product->id,
            'type' => 'like',
            'user_id' => auth()->user()->id
        ]);

        $this->seeInDatabase('emojis', [
            'emojiable_type' => 'product',
            'emojiable_id' => $product->id,
            'type' => 'bad',
            'user_id' => auth()->user()->id
        ]);
    }
}
