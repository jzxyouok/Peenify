<?php

namespace App\Services;

use App\Extensions\syncEmojiToUser;
use App\Repositories\EmojiRepository;

class EmojiService extends Service
{
    use syncEmojiToUser;

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
}