<?php

namespace App\Http\Controllers;

use App\Services\EmojiService;
use Illuminate\Http\Request;

use App\Http\Requests;

class EmojisController extends Controller
{
    public function sync(Request $request, $type, $id)
    {
        $instance = app(ucfirst('App\\' . $type))->find($id);

        if ($instance->isEmoji(auth()->user())) {
            if ($instance->getEmoji('type') == $request->get('emoji')) {
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
