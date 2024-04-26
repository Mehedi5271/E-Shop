@extends('admin.layout.master')
@section('title')
Product List
@endsection

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">E Shop</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Product List</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Trash List
            {{-- <a class="btn btn-sm btn-outline-primary" href="{{ route('products.create') }}">Add New</a>
            <a class="btn btn-sm btn-outline-primary" href="{{ route('products.trash') }}">Trash</a> --}}
        </div>
        <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Is Active</th>
                            <th>Action</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>

                    </tfoot>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->is_active }}</td>
                            <td>
                                <form action="{{ route('products.restore', [$product->id]) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('patch')
                                    <button class="btn btn-sm btn-success" type="submit">Restore</button>
                                </form>
                            </td>

                            <td>
                                <form action="{{ route('products.delete', ['id'=> $product->id]) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                                </form>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
