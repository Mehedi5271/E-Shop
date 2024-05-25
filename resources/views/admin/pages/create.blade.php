@extends('admin.layout.master')

@section('title')
Create

@endsection

@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">E Shop</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item "> <a href="{{route('products.index')}}">Product List</a> </li>
        <li class="breadcrumb-item active">Create Product</li>
    </ol>
    <div class="card mb-4">

    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Product Create <a class="btn btn-sm btn-outline-primary" href="{{route('products.index')}}">Product List</a>
        </div>

<div class="card shadow-lg border-0 rounded-lg mt-1">
    <div class="card-header"><h3 class="text-center font-weight-light my-4">Add New Prodcut</h3></div>
    <div class="card-body">
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-floating mb-3 ">
                <select name="category_id" class="form-control" >
                    <option value="">Selete Category</option>
                    @foreach ($categories as $categoryId => $categorytitle)

                    <option value="{{$categoryId}}">{{$categorytitle}} </option>
                    @endforeach
                </select>
                <label for="category_id"> Category</label>
            </div>
            @error('category_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-floating mb-3 ">
                <input class="form-control" name="title" id="title" type="text" value="{{ old('title') }}" placeholder="Enter Title" />
                <label for="inputFirstName"> Title</label>
            </div>
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-floating mb-3">
                <input class="form-control" name="price" id="price" type="number" value="{{ old('price') }}" placeholder="Enter Price" />
                <label for="inputEmail">Price</label>
            </div>
            @error('price')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

                    <div class="form-floating mb-3 ">
                        <textarea class="form-control" name="description" id="description" value="{{ old('description') }}"  placeholder="Enter Description" ></textarea>

                        <label for="description">Description</label>
                    </div>
                    @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-check">
                        <input class="form-check-input" name="is_active" value="1" type="checkbox" value="" id="isActive" checked>
                        <label class="form-check-label" for="isActive">
                          Is Active
                        </label>
                      </div> <br>

                      <div class="form-floating mb-3">
                        <input type="file" class="form-control" accept="image/*" name="image" id="image" accept="image/*">
                        <label for="image">Upload Image</label>
                    </div>
                    @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <label for="color">Color</label>
                    @foreach ($colors as $colorId=>$colorName)

                    <div class="form-check">
                        <input class="form-check-input" name="color_id[]" value="{{$colorId}}" type="checkbox"  id="{{$colorId}}" >
                        <label class="form-check-label" for="{{$colorId}}"> {{$colorName}} </label>
                    </div>
                    @endforeach
                    <br> <br>

            <div class="mt-4 mb-0">
                <div class="d-grid"><button type="submit" class="btn btn-primary btn-block" >Submit</button></div>
            </div>
        </form>
    </div>

</div>

</div>
@endsection
