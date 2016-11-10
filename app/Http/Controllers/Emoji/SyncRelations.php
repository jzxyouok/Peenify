<?php

namespace App\Http\Controllers\Emoji;

use App\Services\EmojiService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SyncRelations extends Controller
{
    /**
     * @var EmojiService
     */
    private $emojiService;

    public function __construct(EmojiService $emojiService)
    {
        $this->emojiService = $emojiService;
    }

    public function __invoke(Request $request, $type, $id)
    {
        $instance = app(ucfirst('App\\' . ucfirst($type)))->find($id);

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
