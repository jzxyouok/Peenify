<?php

namespace App\Http\Controllers;

use App\Services\EmojiService;
use Illuminate\Http\Request;

use App\Http\Requests;

class EmojisController extends Controller
{
    /**
     * @var EmojiService
     */
    private $emojiService;

    public function __construct(EmojiService $emojiService)
    {
        $this->emojiService = $emojiService;
    }

    public function sync(Request $request, $emojiable_type, $emojiable_id)
    {
        $result = $this->emojiService->syncEmoji($emojiable_type, $emojiable_id, $request->all());

        return response()->json(['status' => ($result) ? 'create' : 'edit']);
    }

    public function showByUser($user_id)
    {
        $emojis = $this->emojiService->getAllByUser($user_id);

        return view('users.emojis', compact('emojis'));
    }
}
