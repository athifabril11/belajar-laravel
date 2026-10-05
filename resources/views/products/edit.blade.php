@extends('layouts.app')

@section('content')
<div class="container-fluid py-2">
    <h1 class="h3 mb-4 font-bold text-gray-800">Edit Product</h1>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('products.update', $product) }}" method="POST">
                @csrf
                @method('PUT')

                @include('products._form')

                <div class="mt-4">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
