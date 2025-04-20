@extends('layout.app') {{-- Menggunakan layout utama 'app.blade.php' --}}
@section('title', 'Wishlist Travels') {{-- Mengatur judul halaman --}}

@section('content')
<div class="container-fluid">
    {{-- Header halaman dengan tombol tambah --}}
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h3 text-gray-800 m-0">Wishlist Travels</h1>
        {{-- Tombol untuk membuka modal tambah data --}}
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertModal">Tambah</button>
    </div>

    {{-- Kartu untuk membungkus tabel data --}}
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                {{-- Tabel menampilkan data travel --}}
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Place Name</th>
                            <th>Location</th>
                            <th>Travel Type</th>
                            <th>Priority</th>
                            <th>Estimate Cost</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Loop untuk menampilkan semua data travel dari controller --}}
                        @foreach($travels as $i => $t)
                        <tr id="row-{{ $t->id }}"> {{-- ID baris untuk memudahkan manipulasi dengan JS (edit/delete) --}}
                            <td>{{ $i+1 }}</td> {{-- Nomor urut --}}
                            <td>{{ $t->place_name }}</td> {{-- Nama tempat --}}
                            <td>{{ $t->location }}</td> {{-- Lokasi --}}
                            <td>{{ $t->travel_type }}</td> {{-- Jenis travel --}}
                            <td>{{ $t->priority_level }}</td> {{-- Tingkat prioritas --}}
                            <td>{{ number_format($t->estimated_cost) }}</td> {{-- Biaya yang diestimasikan --}}
                            <td>
                                {{-- Tombol aksi: detail, edit, delete (semua panggil JS function AJAX) --}}
                                <button class="btn btn-info btn-sm" onclick="openDetailModal({{ $t->id }})">Detail</button>
                                <button class="btn btn-warning btn-sm" onclick="openEditModal({{ $t->id }})">Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="openDeleteModal({{ $t->id }})">Delete</button>
                            </td>
                        </tr>
                        @endforeach {{-- Akhir dari looping --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Menyisipkan file blade untuk modal insert, edit, detail, dan delete --}}
@include('travels.insert') {{-- Modal untuk tambah data --}}
@include('travels.edit')   {{-- Modal untuk edit data --}}
@include('travels.detail') {{-- Modal untuk menampilkan detail --}}
@include('travels.delete') {{-- Modal untuk konfirmasi hapus --}}
@endsection

{{-- Menjalankan semua stack script JS dari file-file modal di atas --}}
@stack('scripts')
