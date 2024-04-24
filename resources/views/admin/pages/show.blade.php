@extends('admin.layout.master')
@section('title')
Product List

@endsection

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4"> E Shop</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active">Product List</li>
    </ol>
    <div class="card lg-12">
        <div class="card" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">{{$products->title}}</h5>
              <p class="card-text" >Description: {{$products->description}}</p>
              <p class="card-text">Price: {{$products->price}}</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
    </div>

</div>
@endsection
