@extends('layouts.app')

@section('content')
<div class="container-fluid py-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 font-bold text-gray-800">Detail Product</h1>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-bordered mb-0">
                <tr>
                    <th width="200" class="bg-light">Nama</th>
                    <td>{{ $product->name }}</td>
                </tr>
                <tr>
                    <th class="bg-light">Kategori</th>
                    <td>{{ $product->category ?? '-' }}</td>
                </tr>
                <tr>
                    <th class="bg-light">Deskripsi</th>
                    <td>{{ $product->description ?? '-' }}</td>
                </tr>
                <tr>
                    <th class="bg-light">Harga</th>
                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th class="bg-light">Stock</th>
                    <td>{{ $product->stock }}</td>
                </tr>
                <tr>
                    <th class="bg-light">Status</th>
                    <td>
                        @if($product->is_active)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-secondary">Tidak Aktif</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="bg-light">Dibuat</th>
                    <td>{{ $product->created_at ? $product->created_at->format('d-m-Y H:i') : '-' }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
