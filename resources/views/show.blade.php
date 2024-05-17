@extends('layout.layout')

@section('content')
<div class="container mt-5">
    <div class="row">

        @if(isset($product))
        <div class="col-md-12 mb-6">

            <div class="bg-gray-200 p-4">
                <h1 class="text-2xl font-bold">{{ $product['title'] }}</h1>
                <p class="text-gray-700">{{ $product['description'] }}</p>

                <div class="flex flex-wrap">
                    @foreach($product['images'] as $image)
                        <img src="{{ $image }}" alt="Product Image" class="w-32 h-32 mt-4 mr-4">
                    @endforeach
                </div>
                <div class="price">
                <p>Cena: {{ $product['price'] }}</p>
                </div>
            </div>
        </div>
        @else
        <div class="bg-red-200 p-4">
            <p class="text-red-700">Product not found.</p>
        </div>
        @endif

    </div>
</div>
@endsection


