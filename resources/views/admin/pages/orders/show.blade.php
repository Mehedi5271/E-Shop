@extends('admin.layout.master')
@section('title', 'order destails')
Product List



@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4"> E Shop</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Order </li>
    </ol>
    <div class="card lg-12">
        <div class="card" style="width: 18rem;">
            <p>Order Id: {{$order->id}}</p>
            </div>
          </div>
    </div>

</div>
@endsection
