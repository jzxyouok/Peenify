<?php

use App\Product;
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
    public function createEmoji()
    {
        $this->loginFakeUser();

        $product = factory(\App\Product::class)->create();

        app(Product::class)->createEmoji(Product::find($product->id), ['user_id' => auth()->user()->id, 'type' => 'like']);

        $this->seeInDatabase('emojis', [
            'emojiable_type' => 'product',
            'emojiable_id' => $product->id,
            'type' => 'like',
            'user_id' => auth()->user()->id,
        ]);
    }

    /**
     * @test
     * @group emojiable
     */
    public function deleteEmoji()
    {
        $this->loginFakeUser();

        $product = factory(\App\Product::class)->create();

        app(Product::class)->createEmoji(Product::find($product->id), ['user_id' => auth()->user()->id, 'type' => 'like']);

        app(Product::class)->deleteEmoji(Product::find($product->id), ['user_id' => auth()->user()->id, 'type' => 'like']);

        $this->dontSeeInDatabase('emojis', [
            'emojiable_type' => 'product',
            'emojiable_id' => $product->id,
            'type' => 'like',
            'user_id' => auth()->user()->id,
        ]);
    }

    /**
     * @test
     * @group emojiable
     */
    public function isExistEmoji()
    {
        $this->loginFakeUser();

        $product = factory(\App\Product::class)->create();

        app(Product::class)->createEmoji(Product::find($product->id), ['user_id' => auth()->user()->id, 'type' => 'like']);

        $result = app(Product::class)->isExistEmoji(Product::find($product->id), ['user_id' => auth()->user()->id]);

        $this->assertEquals(1, $result);
    }

    /**
     * @test
     * @group emojiable
     */
    public function updateEmoji()
    {
        $this->loginFakeUser();

        $product = factory(\App\Product::class)->create();

        app(Product::class)->createEmoji(Product::find($product->id), ['user_id' => auth()->user()->id, 'type' => 'like']);

        app(Product::class)->updateEmoji(Product::find($product->id), ['user_id' => auth()->user()->id, 'type' => 'normal']);

        $this->seeInDatabase('emojis', [
            'emojiable_type' => 'product',
            'emojiable_id' => $product->id,
            'type' => 'normal',
        ]);
    }

    /**
     * @test
     * @group emojiable
     */
    public function syncEmojiWithCreate()
    {
        $this->loginFakeUser();

        $product = factory(\App\Product::class)->create();

        app(Product::class)->syncEmoji($product->id, ['user_id' => auth()->user()->id, 'type' => 'like']);

        $this->seeInDatabase('emojis', [
            'emojiable_type' => 'product',
            'emojiable_id' => $product->id,
            'type' => 'like',
            'user_id' => auth()->user()->id,
        ]);
    }

    /**
     * @test
     * @group emojiable
     */
    public function syncEmojiWithDelete()
    {
        $this->loginFakeUser();

        $product = factory(\App\Product::class)->create();

        app(Product::class)->createEmoji(Product::find($product->id), ['user_id' => auth()->user()->id, 'type' => 'like']);

        app(Product::class)->syncEmoji($product->id, ['user_id' => auth()->user()->id, 'type' => 'like']);

        $this->dontSeeInDatabase('emojis', [
            'emojiable_type' => 'product',
            'emojiable_id' => $product->id,
            'user_id' => auth()->user()->id,
            'type' => 'like',
        ]);
    }
}
