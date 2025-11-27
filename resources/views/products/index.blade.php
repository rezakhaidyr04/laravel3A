@extends('layouts.app')

@section('title','Daftar Produk')

@push('styles')
<style>
    .products-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:14px}
    .products-table{width:100%;border-collapse:collapse;background:transparent;border-radius:8px;overflow:hidden}
    .products-table thead th{background:transparent;text-align:left;padding:12px 10px;color:#cfe8ff;font-size:0.9rem;border-bottom:1px solid rgba(255,255,255,0.04)}
    .products-table tbody td{padding:12px 10px;border-bottom:1px solid rgba(255,255,255,0.03);color:#e6eef6;vertical-align:middle}

    .products-table tbody tr{transition:background .12s, transform .08s}
    .products-table tbody tr:hover{background:linear-gradient(90deg, rgba(124,58,237,0.04), rgba(6,182,212,0.02));transform:translateY(-2px)}

    .product-title{font-weight:700;color:#fff}
    .product-desc{color:#cfe8ff;max-width:420px;white-space:pre-wrap}
    .product-price{font-weight:700;color:#e6eef6}
    .product-stock{color:var(--muted)}

    .actions-inline{display:flex;gap:8px;align-items:center}
    .actions-inline form{display:inline}
    .btn-delete{background:#ff6b6b;color:#fff;border-radius:8px;padding:8px 10px;border:0}

    .empty-state{padding:36px;text-align:center;color:var(--muted);background:rgba(255,255,255,0.02);border-radius:10px}

    /* Mobile: convert rows to cards */
    @media (max-width:720px){
        .products-table thead{display:none}
        .products-table tbody td{display:block;padding:10px 12px}
        .products-table tbody tr{margin-bottom:12px;display:block;border-radius:12px;background:linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));padding:12px;border:1px solid rgba(255,255,255,0.03)}
        .product-title{font-size:1.02rem}
        .product-desc{opacity:0.95}
        .product-meta{display:flex;gap:10px;margin-top:8px}
    }
</style>
@endpush

@section('content')
<div class="wrap">
    <div class="card">
        <div class="products-header">
            <div>
                <h1>Daftar Produk</h1>
                <div class="sub">Daftar lengkap produk — kelola produk Anda di sini.</div>
            </div>
            <div>
                <a href="{{ route('products.create') }}" class="btn btn-primary">Tambah Produk</a>
            </div>
        </div>

        @if($products->isEmpty())
            <div class="empty-state">Belum ada produk. Silakan tambahkan produk baru.</div>
        @else
            <div style="overflow:auto">
                <table class="products-table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td class="product-title">{{ $product->title }}</td>
                            <td class="product-desc">{{ Str::limit($product->description, 140) }}</td>
                            <td class="product-stock">{{ $product->stock }}</td>
                            <td class="product-price">Rp {{ number_format($product->price,0,',','.') }}</td>
                            <td class="product-actions">
                                <div class="actions-inline">
                                    <a href="{{ route('products.edit',$product->id) }}" class="btn btn-ghost">Edit</a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div style="margin-top:14px;display:flex;justify-content:flex-end">{{ $products->links() }}</div>
        @endif
    </div>
</div>
@endsection
