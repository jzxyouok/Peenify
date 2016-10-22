<?php

namespace App\Http\Controllers;

use App\Emoji;
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

    public function showByUser($user_id)
    {
        $emojis = $this->emojiService->getPaginationByUser($user_id, 12);

        return view('users.emojis', compact('emojis'));
    }

    public function sync(Request $request, $type, $id)
    {
        $instance = app(ucfirst('App\\' . $type))->find($id);

        if ($instance->isEmoji(auth()->user())) {
            if ($instance->getEmoji(auth()->user(), 'type') == $request->get('emoji')) {
                $instance->unEmoji(auth()->user());

                return response()->json(['status' => 'unEmoji']);
            }

            $instance->updateEmoji(auth()->user(), $request->get('emoji'));

            return response()->json(['status' => 'updateEmoji']);
        }

        $instance->emoji(auth()->user(), $request->get('emoji'));

        return response()->json(['status' => 'emoji']);
    }
}
