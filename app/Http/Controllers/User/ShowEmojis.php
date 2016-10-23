<?php

namespace App\Http\Controllers\User;

use App\Services\EmojiService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ShowEmojis extends Controller
{
    /**
     * @var EmojiService
     */
    private $emojiService;

    public function __construct(EmojiService $emojiService)
    {
        $this->emojiService = $emojiService;
    }

    public function __invoke($id)
    {
        $emojis = $this->emojiService->getPaginationByUser($id, 12);

        return view('users.emojis', compact('emojis'));
    }
}
