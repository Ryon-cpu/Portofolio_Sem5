<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:40'],
            'service' => ['nullable', 'string', 'max:120'],
            'subject' => ['nullable', 'string', 'max:180'],
            'message' => ['required', 'string', 'max:5000'],
        ]);
        $contactMessage = ContactMessage::query()->create($validated);

        return response()->json([
            'message' => 'Pesan berhasil dikirim.',
            'id' => $contactMessage->id,
        ], 201);
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'data' => ContactMessage::query()
                ->latest('id')
                ->paginate(25),
        ]);
    }

    public function markRead(ContactMessage $contactMessage): JsonResponse
    {
        $contactMessage->update(['is_read' => true]);

        return response()->json(['data' => $contactMessage->fresh()]);
    }

    public function destroy(ContactMessage $contactMessage): JsonResponse
    {
        $contactMessage->delete();

        return response()->json(['deleted' => true]);
    }
}
