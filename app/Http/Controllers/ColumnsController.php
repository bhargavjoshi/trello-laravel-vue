<?php

namespace App\Http\Controllers;

use App\Models\Column;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ColumnsController extends Controller
{
    public function postAddColumn(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|unique:columns|max:255',
            'sequence' => 'required',
        ]);

        $column = new Column();
        $column->title = $request->input('title');
        $column->sequence = $request->input('sequence');
        $column->save();

        return response()->json($column);
    }

    public function getColumns(): JsonResponse
    {
        $columns = Column::query()
            ->with(['cards' => function ($query) {
                $query->orderBy('sequence', 'ASC');
            }])
            ->orderBy('sequence', 'ASC')
            ->get();

        return response()->json($columns);
    }

    public function deleteColumn(Request $request): JsonResponse
    {
        // Validate rules to create card.
        $validated = $request->validate([
            'column_id' => 'required|exists:columns,id',
        ]);

        $column = Column::findOrFail($request->input('column_id'));
        $column->delete();

        return response()->json(['success' => true]);
    }
}
