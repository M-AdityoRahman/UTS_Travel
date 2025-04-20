@extends('layout.app')
@section('title', 'Dashboard')

@section('content')

<div class="container mt-4">
    <h2 class="mb-4 text-center">Selamat Datang di Dashboard Wishlist Travel</h2>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        
        <div class="col">
            <div class="card h-100 shadow-sm">
                <img src="{{ asset('images/gambar1.jpg') }}" class="card-img-top" alt="Maldives">
                <div class="card-body">
                    <h5 class="card-title">Maldives</h5>
                    <p class="card-text">Maldives dikenal dengan laut birunya yang jernih dan vila terapung yang mewah. Tempat ini sempurna untuk bulan madu atau liburan santai yang penuh kemewahan.</p>
                </div>
            </div>
        </div>

        
        <div class="col">
            <div class="card h-100 shadow-sm">
                <img src="{{ asset('images/gambar2.jpg') }}" class="card-img-top" alt="Swiss">
                <div class="card-body">
                    <h5 class="card-title">Lauterbrunnen, Swiss</h5>
                    <p class="card-text">Lauterbrunnen adalah desa di Swiss yang dikelilingi oleh air terjun dan pegunungan Alpen. Pemandangannya sangat memukau dan cocok untuk pencinta alam.</p>
                </div>
            </div>
        </div>

        
        <div class="col">
            <div class="card h-100 shadow-sm">
                <img src="{{ asset('images/gambar3.jpg') }}" class="card-img-top" alt="Tari Kecak">
                <div class="card-body">
                    <h5 class="card-title">Tari Kecak, Bali</h5>
                    <p class="card-text">Tari Kecak adalah pertunjukan tradisional Bali yang memukau dengan nyanyian dan formasi tari khas. Sering dipentaskan saat matahari terbenam di Pura Uluwatu.</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
