@extends('layout.app')
@section('title', 'travels')
@section('content')



    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">WishList Travels</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
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
                        <?php $no = 1 ?>
                        @foreach ($travels as $t )
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$t->place_name}}</td>
                            <td>{{$t->location}}</td>
                            <td>{{$t->travel_type}}</td>
                            <td>{{$t->priority_level}}</td>
                            <td>{{ number_format($t->estimated_cost, 0, ',', '.') }}</td>
                            <td>
                                <a href="" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                <a href="" class="btn btn-warning btn-sm"><i class="fas fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                        
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection