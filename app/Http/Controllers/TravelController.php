<?php

namespace App\Http\Controllers;

use App\Models\TravelWishlist;
use Illuminate\Http\Request;

class TravelController extends Controller
{
    // Menampilkan semua data wishlist travel ke halaman index
    public function index() {
        $travels = TravelWishlist::all(); // Ambil semua data dari tabel travel_wishlists
        return view('travels.index', compact('travels')); // Tampilkan ke view
    }

    // Menyimpan data travel wishlist baru
    public function store(Request $request)
    {
        try {
            // Validasi inputan dari form
            $validated = $request->validate([
                'place_name' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'travel_type' => 'required|string',
                'priority_level' => 'required|integer|between:1,5',
                'estimated_cost' => 'required|numeric|min:100000'
            ]);
    
            // Simpan data ke database
            $travel = TravelWishlist::create($validated);
            
            // Kirim respon JSON berhasil
            return response()->json([
                'success' => true,
                'message' => 'Travel added successfully',
                'data' => $travel
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Kirim respon JSON jika validasi gagal
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            // Kirim respon JSON jika terjadi error umum
            return response()->json([
                'success' => false,
                'message' => 'Failed to add travel'
            ], 500);
        }
    }

    // Menampilkan detail travel wishlist berdasarkan ID
    public function show($id)
    {
        try {
            $travel = TravelWishlist::findOrFail($id); // Cari data berdasarkan ID
            return response()->json([
                'success' => true,
                'data' => $travel
            ]);
        } catch (\Exception $e) {
            // Kirim respon JSON jika data tidak ditemukan
            return response()->json([
                'success' => false,
                'message' => 'Travel not found'
            ], 404);
        }
    }

    // Mengupdate data travel wishlist berdasarkan ID
    public function update(Request $request, $id)
    {
        // Validasi data yang masuk (boleh sebagian)
        $validated = $request->validate([
            'place_name' => 'sometimes|string|max:255',
            'location' => 'sometimes|string|max:255',
            'travel_type' => 'sometimes|string',
            'priority_level' => 'sometimes|integer|between:1,5',
            'estimated_cost' => 'sometimes|numeric|min:100000'
        ]);

        try {
            $travel = TravelWishlist::findOrFail($id); // Cari data berdasarkan ID
            $travel->update($validated); // Update data
            
            return response()->json([
                'success' => true,
                'message' => 'Travel updated successfully',
                'data' => $travel
            ]);
        } catch (\Exception $e) {
            // Kirim respon JSON jika update gagal
            return response()->json([
                'success' => false,
                'message' => 'Update failed'
            ], 500);
        }
    }

    // Menghapus data travel wishlist berdasarkan ID
    public function destroy($id)
    {
        try {
            $travel = TravelWishlist::findOrFail($id); // Cari data berdasarkan ID
            $travel->delete(); // Hapus data
            return response()->json([
                'success' => true,
                'message' => 'Deleted successfully'
            ]);
        } catch (\Exception $e) {
            // Kirim respon JSON jika gagal hapus
            return response()->json([
                'success' => false,
                'message' => 'Delete failed'
            ], 500);
        }
    }
}
