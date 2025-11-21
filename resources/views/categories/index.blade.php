@extends('layouts.sneat')

@section('title', 'Daftar Kategori Produk')

@section('content')

<div class="mb-4">
    <h5 class="text-muted">Master Data / <span class="fw-bold">Daftar Kategori Produk</span></h5>
</div>

<div class="card p-3">

    {{-- Header + tombol --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3 gap-3">
        <h5 class="m-0">Daftar Kategori Produk</h5>

        <a href="{{ route('categories.create') }}" class="btn btn-primary d-flex align-items-center gap-1">
            <i class="bx bx-plus"></i> Tambah Kategori
        </a>
    </div>

    {{-- Search --}}
    <form method="GET" action="{{ route('categories.index') }}" class="d-flex gap-2 mb-3 flex-wrap">

        <div class="input-group" style="max-width: 350px;">
            <span class="input-group-text bg-white border-end-0">
                <i class="bx bx-search"></i>
            </span>
            <input 
                type="text" 
                class="form-control border-start-0" 
                name="search"
                placeholder="Cari nama kategori..."
                value="{{ request('search') }}"
            >
        </div>

        <button class="btn btn-primary d-flex align-items-center gap-1 px-4" type="submit">
            <i class="bx bx-search-alt"></i> Cari
        </button>

        @if(request('search'))
        <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
            Reset
        </a>
        @endif

    </form>

    {{-- Tabel --}}
    <div class="table-responsive">
        <table class="table align-middle">
            
            <thead class="table-light">
                <tr>
                    <th style="width: 60px;">ID</th>
                    <th>Nama Kategori</th>
                    <th style="width: 160px;">Dibuat</th>
                    <th style="width: 160px;">Diupdate</th>
                    <th style="width: 120px;">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($categories as $category)
                <tr>
                    <td><strong>#{{ $category->id }}</strong></td>
                    <td class="fw-bold text-uppercase">{{ $category->nama }}</td>
                    <td>{{ $category->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $category->updated_at->format('d/m/Y H:i') }}</td>
                    <td>

                        <div class="d-flex gap-2">

                            {{-- Edit --}}
                            <a href="{{ route('categories.edit', $category) }}"
                                class="btn btn-sm btn-outline-primary rounded">
                                <i class="bx bx-edit-alt"></i>
                            </a>

                            {{-- Delete --}}
                            <button class="btn btn-sm btn-outline-danger btn-delete-category rounded"
                                data-id="{{ $category->id }}"
                                data-name="{{ $category->nama }}">
                                <i class="bx bx-trash"></i>
                            </button>

                        </div>

                        <form id="delete-category-{{ $category->id }}"
                            action="{{ route('categories.destroy', $category) }}"
                            method="POST"
                            class="d-none">
                            @csrf
                            @method('DELETE')
                        </form>

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        Tidak ada data kategori
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>
    </div>

</div>

@endsection


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.querySelectorAll(".btn-delete-category").forEach(btn => {
    btn.addEventListener("click", function () {
        const id = this.dataset.id;
        const name = this.dataset.name;

        Swal.fire({
            title: "Hapus Kategori?",
            html: `Yakin ingin menghapus <b>${name}</b>?`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, hapus",
            cancelButtonText: "Batal",
            confirmButtonColor: "#d33",
        }).then(result => {
            if (result.isConfirmed) {
                document.getElementById(`delete-category-${id}`).submit();
            }
        });
    });
});
</script>
@endpush
