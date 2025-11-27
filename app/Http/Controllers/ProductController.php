<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

use Illuminate\View\View;

use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    public function index() : View
    {
        // ini coding untuk ambil data ke model yang namanya product
        $products = Product::latest()->paginate(10);

        // ini coding menuju ke interface dengan membawa data dari model product
        return view('products.index', compact('products'));
    }

    public function create() : View
    {
        #CODING MENUJU TAMPILAN FORM TAMBAH PRODUK, yang tidak bawa data
        return view('products.tambahproduk');
    }

    public function store(Request $request) : RedirectResponse
    {
        #ini untuk membuat validasi form
        $request->validate([
            'txtnama' => 'required', # required artinya wajib untuk diisi
            'txtdeskripsi' => 'required|min:5',
            'txtstok' => 'required|numeric',
            'txtharga' => 'required|numeric'
        ]);

        #ini coding simpan data
        Product::create([
            'title' => $request->txtnama,
            'description' => $request->txtdeskripsi,
            'price' => $request->txtharga,
            'stock' => $request->txtstok
        ]);

        return redirect()->route('products.index');
    }

    public function edit(string $id) : View
    {
        # ini coding untuk ambil data ke model berdasarkan id (primarykey)
        $product = Product::findOrFail($id);

        #ini coding menuju interface sambil membawa data yang didapat berdasarkan id
        return view('products.editproduk', compact('product'));
    }
    public function update (Request $request, $id): RedirectResponse
    {
        #ini untuk membuat validasi form
        $request->validate([
            'txtnama' => 'required', # required artinya wajib untuk diisi
            'txtdeskripsi' => 'required|min:5',
            'txtstok' => 'required|numeric',
            'txtharga' => 'required|numeric'
        ]);
        

        // cari dulu yang mau di update berdasarkan id (primarykey)
        $product = Product::findOrFail($id);

        #ini coding simpan data
        $product->update([
            'title' => $request->txtnama,
            'description' => $request->txtdeskripsi,
            'price' => $request->txtharga,
            'stock' => $request->txtstok
        ]);

        return redirect()->route('products.index'); 
    }

    public function destroy(string $id) : RedirectResponse
    {
        //cari dulu yang mau di hapus berdasarkan id (primarykey)

        $product = Product::findOrFail($id);

        // fungsi hapus data
        $product->delete();

        return redirect()->route('products.index');
    }

    
}