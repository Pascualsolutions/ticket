@extends('layout.layout')

@section('content')

<div class="container mt-5">
    <div class="row">
        @if (isset($products) && count($products) > 0)
            @foreach ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img class="card-img-top" src="{{ $product['thumbnail'] }}" alt="{{ $product['title'] }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product['title'] }}</h5>
                            <p class="card-text">
                                {{ strlen($product['description']) > 20 ? substr($product['description'], 0, 20) . '...' : $product['description'] }}
                            </p>
                            <p class="card-text price"><strong>Cena:</strong> ${{ $product['price'] }}</p>
                            <a href="{{ route('show', $product['id']) }}" class="btn btn-primary mt-auto">Detalji</a>
                        </div>
                    </div>
                </div>
            @endforeach

            @if ($products instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="col-12">
                    {{ $products->links() }} <!-- Add this line for pagination -->
                </div>
            @endif

        @else
            <div class="col-12">
                <div class="alert alert-warning" role="alert">
                    No products available.
                </div>
            </div>
        @endif
    </div>
</div>

@endsection


