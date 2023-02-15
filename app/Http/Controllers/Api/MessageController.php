<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MessageController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $messages = Message::all();

        return MessageResource::collection($messages);
    }

    public function send(Request $request): MessageResource
    {
        $message = new Message([
            'name' => $request->get('content'),
            'senderId' => $request->get('userId'),
        ]);

        $message->save();

        return new MessageResource($message);
    }
}
