@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <x-breadcrumb :items="[
      'Produk' => route('products.index'),
      'Daftar Produk' => ''
  ]" />

  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Daftar Produk</h5>
      <form action="{{ route('products.index') }}" method="GET" class="d-flex" style="width: 300px;">
        <input type="text" name="search" class="form-control me-2" placeholder="Cari..." value="{{ request('search') }}">
        <button class="btn btn-primary btn-sm" type="submit"><i class="bx bx-search"></i></button>
      </form>
    </div>

    <div class="card-body">
      <div class="table-responsive text-nowrap">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Foto</th>
              <th>Nama</th>
              <th>Harga</th>
              <th>Stok</th>
              <th>Deskripsi</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($products as $index => $product)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td class="p-2 border text-center">
                  @if($product->foto)
                    <img src="{{ asset('storage/' . $product->foto) }}" alt="{{ $product->nama }}" class="w-24 h-24 object-cover rounded-md mx-auto" width="80">
                  @else
                    -
                  @endif
                </td>
                <td>{{ $product->nama }}</td>
                <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                <td>{{ $product->stok }}</td>
                <td class="p-2 border whitespace-normal break-words">
                {{ $product->deskripsi }}
                </td>
                <td>
                  <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-primary"><i class="bx bx-edit"></i></a>
                  <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus produk ini?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="mt-3 d-flex justify-content-center">
        {{ $products->links() }} {{-- pagination --}}
      </div>
    </div>
  </div>
</div>
@endsection
