@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<div class="wrap">
    <div class="card">
        <div class="header">
            <div>
                <h1>Edit Produk</h1>
                <div class="sub">Perbarui informasi produk — nama, deskripsi, stok, dan harga.</div>
            </div>
            <div>
                <a href="{{ route('products.index') }}" class="btn btn-ghost">Kembali</a>
            </div>
        </div>

        @if ($errors->any())
            <div style="margin-bottom:12px;padding:12px;border-radius:10px;background:#fff4f4;border:1px solid #fee2e2;color:#991b1b">
                <strong>Terjadi kesalahan:</strong>
                <ul style="margin:8px 0 0 18px">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST" id="editForm">
            @csrf
            @method('PUT')

            <div class="field float">
                <div class="input-with-icon">
                    <input id="txtnama" name="txtnama" class="input" type="text" value="{{ old('txtnama', $product->title) }}" placeholder=" " autocomplete="off">
                    <label for="txtnama">Nama Produk</label>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" style="pointer-events:none;position:absolute;right:12px;top:50%;transform:translateY(-50%);opacity:0.75"><path d="M3 7a2 2 0 012-2h3l2 3h6a2 2 0 012 2v6a2 2 0 01-2 2H8l-5-6V7z" fill="#cde7ff"/></svg>
                </div>
                @error('txtnama')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="field float">
                <textarea id="txtdeskripsi" name="txtdeskripsi" class="input" rows="5" placeholder=" ">{{ old('txtdeskripsi', $product->description) }}</textarea>
                <label for="txtdeskripsi">Deskripsi</label>
                <div class="helper">Maks 1000 karakter</div>
                <div id="desCount" class="char-count">{{ 1000 - (old('txtdeskripsi') ? strlen(old('txtdeskripsi')) : (isset($product->description) ? strlen($product->description) : 0)) }} karakter tersisa</div>
                @error('txtdeskripsi')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="two">
                <div class="field float">
                    <input id="txtstok" name="txtstok" class="input" type="text" value="{{ old('txtstok', $product->stock) }}" placeholder=" " autocomplete="off">
                    <label for="txtstok">Stok</label>
                    @error('txtstok')<div class="error">{{ $message }}</div>@enderror
                </div>

                <div class="field float">
                    <div class="input-with-icon">
                        <input id="txtharga" name="txtharga" class="input" type="text" value="{{ old('txtharga', number_format($product->price,0,',','.')) }}" placeholder=" " autocomplete="off">
                        <label for="txtharga">Harga (Rp)</label>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" style="pointer-events:none;position:absolute;right:12px;top:50%;transform:translateY(-50%);opacity:0.75"><path d="M12 1v22M17 5H9a4 4 0 100 8h6a4 4 0 010 8H7" stroke="#cde7ff" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                    <div class="helper">Gunakan angka, pemisah ribuan otomatis ditampilkan.</div>
                    @error('txtharga')<div class="error">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="actions">
                <a href="{{ route('products.index') }}" class="btn btn-ghost">Batal</a>
                <button id="submitBtn" type="submit" class="btn btn-primary">Perbarui</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    (function(){
        const price = document.getElementById('txtharga');
        const stock = document.getElementById('txtstok');
        const submitBtn = document.getElementById('submitBtn');
        const des = document.getElementById('txtdeskripsi');
        const desCount = document.getElementById('desCount');

        function onlyDigits(v){ return v ? v.replace(/\D/g,'') : '' }
        function formatRupiah(v){ return v.replace(/\B(?=(\d{3})+(?!\d))/g, '.'); }

        // format harga
        if(price){
            price.addEventListener('input', function(e){
                const raw = onlyDigits(e.target.value);
                e.target.value = raw ? formatRupiah(raw) : '';
                toggleFilled(price);
            });
            toggleFilled(price);
        }

        // stok numeric only
        if(stock){
            stock.addEventListener('input', function(e){ e.target.value = onlyDigits(e.target.value); toggleFilled(stock); });
            toggleFilled(stock);
        }

        // description counter and filled toggle
        if(des){
            des.addEventListener('input', function(e){
                const v = e.target.value || '';
                const rem = Math.max(0, 1000 - v.length);
                if(desCount) desCount.textContent = rem + ' karakter tersisa';
                toggleFilled(des);
            });
            (function(){ const v = des.value || ''; if(desCount) desCount.textContent = Math.max(0,1000 - v.length) + ' karakter tersisa'; toggleFilled(des); })();
        }

        // floating label helpers
        function toggleFilled(el){
            if(!el) return;
            const parent = el.closest('.float');
            if(!parent) return;
            if(el.value && el.value.toString().trim() !== '') parent.classList.add('filled'); else parent.classList.remove('filled');
        }

        // initialize all floats
        document.querySelectorAll('.float .input').forEach(function(inp){ inp.addEventListener('blur', function(){ toggleFilled(inp); }); toggleFilled(inp); });

        // disable submit while submitting (basic UX)
        const form = document.getElementById('editForm');
        if(form){
            form.addEventListener('submit', function(){ submitBtn.disabled = true; submitBtn.textContent = 'Menyimpan...'; });
        }
    })();
</script>
@endpush