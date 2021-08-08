<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageCollection;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MessageController extends Controller
{

    public function listMessages(User $user)
    {
        $userFrom = auth()->user()->id;
        $userTo = $user->id;

        $messages = Message::where(function ($q) use ($userFrom, $userTo){
                                $q->where([
                                    'from' => $userFrom,
                                    'to' => $userTo
                                ]);
                            })->orWhere(function ($q) use ($userFrom, $userTo){
                                $q->where([
                                    'from' => $userTo,
                                    'to' => $userFrom
                                ]);
                            })->orderBy('created_at', 'ASC')->get();

        return response()->json([
            'messages' => new MessageCollection($messages)
        ], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $message = Message::create([
            'from' => auth()->user()->id,
            'to' => $request->to,
            'content' => filter_var($request->message, FILTER_SANITIZE_STRIPPED)
        ]);

        return response()->json([
            'message' => new MessageResource($message)
        ], Response::HTTP_CREATED);
    }

}
