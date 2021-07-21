<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CardsController extends Controller
{
    public function postAddCard(Request $request): JsonResponse
    {
        // Validate rules to create card.
        $validated = $request->validate([
            'column_id' => 'required|exists:columns,id',
            'title' => 'required',
            'description' => 'nullable',
            'sequence' => 'required',
        ]);

        // Add card to database.
        $card = new Card();
        $card->title = $request->input('title');
        $card->description = $request->input('description');
        $card->sequence = $request->input('sequence');
        $card->column_id = $request->input('column_id');
        $card->save();

        // Return Json response
        return response()->json($card);
    }

    public function postUpdateCard(Request $request): JsonResponse
    {
        // Validate rules to update card.
        $validated = $request->validate([
            'card_id' => 'required|exists:cards,id',
            'title' => 'required',
            'description' => 'nullable'
        ]);

        $card = Card::find($request->input('card_id'));
        $card->title = $request->input('title');
        $card->description = $request->input('description');
        $card->save();

        return response()->json($card);
    }

    public function patchCardOrder(Request $request): JsonResponse
    {
        $columns = $request->input('columns');

        // Not the cleanest way to sync, but due to time limitation, I am keep this as it is.
        foreach ($columns as $column) {
            foreach ($column['cards'] as $index => $card) {
                $card = Card::find($card['id']);
                $card->column_id = $column['id'];
                $card->sequence = $index + 1;
                $card->save();
            }
        }

        return response()->json(['success' => true]);
    }
}
