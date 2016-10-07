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

    public function findByUser($user_id)
    {
        return $this->emojiRepository->getByUser($user_id);
    }

    public function getPaginationByUser($user_id, $page = 10)
    {
        return $this->emojiRepository->paginateByUser($user_id, $page);
    }
}