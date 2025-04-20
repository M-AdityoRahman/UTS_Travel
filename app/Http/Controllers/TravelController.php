<?php

namespace App\Http\Controllers;

use App\Models\TravelWishlist;
use Illuminate\Http\Request;

class TravelController extends Controller
{
    public function index() {
        $travels = TravelWishlist::all();
        return view('travels.index', compact('travels'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'place_name' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'travel_type' => 'required|string',
                'priority_level' => 'required|integer|between:1,5',
                'estimated_cost' => 'required|numeric|min:100000'
            ]);
    
            $travel = TravelWishlist::create($validated);
            
            return response()->json([
                'success' => true,
                'message' => 'Travel added successfully',
                'data' => $travel
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add travel'
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $travel = TravelWishlist::findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $travel
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Travel not found'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'place_name' => 'sometimes|string|max:255',
            'location' => 'sometimes|string|max:255',
            'travel_type' => 'sometimes|string',
            'priority_level' => 'sometimes|integer|between:1,5',
            'estimated_cost' => 'sometimes|numeric|min:100000'
        ]);

        try {
            $travel = TravelWishlist::findOrFail($id);
            $travel->update($validated);
            
            return response()->json([
                'success' => true,
                'message' => 'Travel updated successfully',
                'data' => $travel
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Update failed'
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $travel = TravelWishlist::findOrFail($id);
            $travel->delete();
            return response()->json([
                'success' => true,
                'message' => 'Deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Delete failed'
            ], 500);
        }
    }
}
