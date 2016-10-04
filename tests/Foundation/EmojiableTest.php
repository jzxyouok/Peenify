<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EmojiableTest extends TestCase
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
     * @group emojiable
     */
    public function emoji()
    {
        $this->loginFakeUser();

        $instance = factory(\App\Product::class)->create();

        $instance->emoji(auth()->user(), 'like');

        $this->seeInDatabase('emojis', [
            'emojiable_type' => 'product',
            'emojiable_id' => $instance->id,
            'user_id' => auth()->user()->id,
        ]);
    }

    /**
     * @test
     * @group emojiable
     */
    public function unEmoji()
    {
        $this->loginFakeUser();

        $instance = factory(\App\Product::class)->create();

        $instance->emoji(auth()->user(), 'like');

        $instance->unEmoji(auth()->user());

        $this->dontSeeInDatabase('emojis', [
            'emojiable_type' => 'product',
            'emojiable_id' => $instance->id,
            'type' => 'like',
            'user_id' => auth()->user()->id,
        ]);
    }

    /**
     * @test
     * @group emojiable
     */
    public function updateEmoji()
    {
        $this->loginFakeUser();

        $instance = factory(\App\Product::class)->create();

        $instance->emoji(auth()->user(), 'bad');

        $instance->updateEmoji(auth()->user(), 'like');

        $this->seeInDatabase('emojis', [
            'emojiable_type' => 'product',
            'emojiable_id' => $instance->id,
            'type' => 'like',
            'user_id' => auth()->user()->id,
        ]);
    }

    /**
     * @test
     * @group emojiable
     */
    public function isEmoji()
    {
        $this->loginFakeUser();

        $instance = factory(\App\Product::class)->create();

        $instance->emoji(auth()->user(), 'like');

        $result = $instance->isEmoji(auth()->user(), 'like');

        $this->assertTrue($result);
    }

    /**
     * @test
     * @group emojiable
     */
    public function isEmojiWithNoArgs()
    {
        $this->loginFakeUser();

        $instance = factory(\App\Product::class)->create();

        $instance->emoji(auth()->user(), 'like');

        $result = $instance->isEmoji(auth()->user());

        $this->assertTrue($result);
    }

    /**
     * @test
     * @group emojiable
     */
    public function isEmojiFalse()
    {
        $this->loginFakeUser();

        $instance = factory(\App\Product::class)->create();

        $instance->emoji(auth()->user(), 'bad');

        $result = $instance->isEmoji(auth()->user(), 'like');

        $this->assertFalse($result);
    }

    /**
     * @test
     * @group emojiable
     */
    public function getEmoji()
    {
        $this->loginFakeUser();

        $instance = factory(\App\Product::class)->create();

        $instance->emoji(auth()->user(), 'bad');

        $result = $instance->getEmoji('type');

        $this->assertEquals('bad', $result);
    }
}
