<?php

namespace App\Services;

use App\Repositories\EmojiRepository;

class EmojiService extends Service
{
    /**
     * @var EmojiRepository
     */
    private $emojiRepository;

    public function __construct(EmojiRepository $emojiRepository)
    {
        $this->emojiRepository = $emojiRepository;
    }

    public function getAllByUser($user_id)
    {
        return $this->emojiRepository->getAllByUser($user_id);
    }

    public function syncEmoji($emojiable_type, $emojiable_id, $attributes)
    {
        $instance = app(ucfirst('App\\' . $emojiable_type));

        return $instance->syncEmoji($emojiable_id, array_add($attributes, 'user_id', auth()->user()->id));
    }
}