@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <x-breadcrumb :items="[
      'Produk' => route('products.index'),
      'Tambah Produk' => ''
  ]" />

  <div class="row">
    <div class="mb-4">
      <a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="bx bx-arrow-back"></i> Kembali</a>
    </div>

    <div class="col-xxl">
      <div class="card mb-4">
        <div class="card-body">
        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="row mb-3">
        {{-- NAMA --}}
        <div class="col-md-6">
            <label class="form-label" for="nama">Nama</label>
            <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-package"></i></span>
                <input type="text" name="nama" id="nama"
                    class="form-control @error('nama') is-invalid @enderror"
                    placeholder="Nama produk" value="{{ old('nama') }}">
                @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        {{-- KATEGORI --}}
        <div class="col-md-6">
            <label class="form-label" for="kategori_id">Kategori</label>
            <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-category"></i></span>
                <select name="kategori_id" id="kategori_id"
                    class="form-control @error('kategori_id') is-invalid @enderror">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('kategori_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->nama }}
                        </option>
                    @endforeach
                </select>
                @error('kategori_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
    </div>

    <div class="row mb-3">
        {{-- HARGA --}}
        <div class="col-md-6">
            <label class="form-label" for="harga">Harga</label>
            <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-dollar-circle"></i></span>
                <input type="text" name="harga" id="harga"
                    class="form-control @error('harga') is-invalid @enderror"
                    placeholder="100000" value="{{ old('harga') }}">
                @error('harga') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        {{-- STOK --}}
        <div class="col-md-6">
            <label class="form-label" for="stok">Stok</label>
            <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-package"></i></span>
                <input type="text" name="stok" id="stok"
                    class="form-control @error('stok') is-invalid @enderror"
                    placeholder="10" value="{{ old('stok') }}">
                @error('stok') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
    </div>

    {{-- FOTO --}}
    <div class="row mb-3">
      <div class="col-md-12">
          <label class="form-label" for="foto">Foto</label>

          <div class="border rounded p-3" style="border: 1px solid #d0d0d0;">
              <input type="file" name="foto" id="foto"
                  class="form-control @error('foto') is-invalid @enderror">

              @error('foto') 
                  <div class="invalid-feedback d-block">{{ $message }}</div> 
              @enderror
          </div>
        </div>
      </div>

    {{-- DESKRIPSI (full width) --}}
    <div class="row mb-3">
        <div class="col-md-12">
            <label class="form-label" for="deskripsi">Deskripsi</label>
            <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-comment-detail"></i></span>
                <textarea name="deskripsi" id="deskripsi"
                    class="form-control @error('deskripsi') is-invalid @enderror"
                    placeholder="Deskripsi produk">{{ old('deskripsi') }}</textarea>
                @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
    </div>

    {{-- BUTTON --}}
    <div class="row justify-content-end">
        <div class="col-md-10 text-end">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
</form>

        </div>
      </div>
    </div>
  </div>

</div>
@endsection
