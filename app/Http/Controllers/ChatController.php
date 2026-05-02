<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // Daftar semua room chat pembeli
    public function index()
    {
        $userId = Auth::id();

        // Ambil semua user yang pernah chatting sama kita
        $rooms = Message::where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->with(['sender', 'receiver', 'product'])
            ->latest()
            ->get()
            ->groupBy(function ($msg) use ($userId) {
                // Group by lawan bicara
                return $msg->sender_id === $userId
                    ? $msg->receiver_id
                    : $msg->sender_id;
            })
            ->map(function ($msgs) use ($userId) {
                $last = $msgs->first();
                $lawanId = $last->sender_id === $userId
                    ? $last->receiver_id
                    : $last->sender_id;
                return [
                    'lawan'        => User::find($lawanId),
                    'pesan_terakh' => $last->pesan,
                    'waktu'        => $last->created_at,
                    'belum_dibaca' => $msgs->where('receiver_id', $userId)->where('dibaca', false)->count(),
                ];
            });

        return view('chat', compact('rooms'));
    }

    // Buka room chat dengan seller tertentu
    public function show(User $seller)
    {
        $userId = Auth::id();

        $messages = Message::where(function ($q) use ($userId, $seller) {
                $q->where('sender_id', $userId)->where('receiver_id', $seller->id);
            })->orWhere(function ($q) use ($userId, $seller) {
                $q->where('sender_id', $seller->id)->where('receiver_id', $userId);
            })
            ->with(['sender', 'product'])
            ->oldest()
            ->get();

        // Tandai semua pesan masuk sebagai dibaca
        Message::where('sender_id', $seller->id)
            ->where('receiver_id', $userId)
            ->where('dibaca', false)
            ->update(['dibaca' => true]);

        return view('chat-room', compact('messages', 'seller'));
    }

    // Kirim pesan
    public function send(Request $request)
    {
        $request->validate(['receiver_id' => 'required|exists:users,id', 'pesan' => 'required|string|max:1000']);

        Message::create([
            'sender_id'   => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'product_id'  => $request->product_id ?? null,
            'pesan'       => $request->pesan,
        ]);

        return back();
    }
}