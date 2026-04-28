<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use function PHPUnit\Framework\returnArgument;

class ProductController extends Controller
{
    public function landing(){
        $produkTerbaru = Product::where('status', 'tersedia')
        ->latest()
        ->take(8)
        ->get();

        return view('welcome', compact('produkTerbaru'));
    }
    
    //index nampilin smua y kyk rak toko
    public function index(){
        $produk = Product::when('status', 'tersedia')
            ->latest()
            ->paginate(12);
            //paginate tu cmn nampilin 12 per halamn, jd kl mw liat selanjutny ya geser
            //findprfail ya kl gada produk otomatis 404

            return view('produk.index', compact('produk'));
    }

    //detail 1 produk show
    public function show($id){
        $produk = Product::findOrFail($id);

        return view('produk.show', compact('produk'));
    }

    //hlmn form upload produk yg mau dijual
    public function create(){
        return view('produk.create');
    }

    //proses simpn prduk baru mulai dr ngisi form
    public function store(Request $request){
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'kategori' => 'required',
            'kondisi' => 'required',
            'foto' => 'required|image',
        ]);

        Product::create([
            'user_id' => auth()->id(),
            'nama' => $request->nama,
            'harga' => $request->harga,
            'kategori' => $request->kategori,
            'kondisi' => $request->kondisi,
            'status' => 'tersedia',
            'foto' => $request->file('foto')->store('produk','public'),
        ]);

        return redirect()->route('produk.index')
            ->with('success', 'produk berhasil diupload !');
    }

    //hapus produk
    public function destroy($id){
        $produk = Product::findOrFail($id);

        //memastikan yg ngapus produk itu pemilikny
        if ($produk->user_id !== auth()->id()){
            abort(403);
        }

        $produk->delete();

        return redirect()->route('produk.index')
            ->with ('success', 'produk berhasil dihapus!');
    }

}