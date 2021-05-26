<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
  public function index()
  {
    $produk = Produk::all();
    return view('produk', ['produk' => $produk]);
  }

  public function tambah()
    {
    	return view('produk_tambah');
    }

    public function store(Request $request)
        {
        	$this->validate($request,[
        		'nama_produk' => 'required',
        		'keterangan' => 'required',
            'harga' => 'required',
            'jumlah' => 'required'
        	]);

            Produk::create([
        		'nama_produk' => $request->nama_produk,
        		'keterangan' => $request->keterangan,
            'harga' => $request->harga,
            'jumlah' => $request->jumlah,
        	]);

        	return redirect('/produk');
        }

  public function edit($nama)
    {
      $produk= DB::table('produk')->where('nama_produk',$nama)->get();
      return view('produk_edit', ['produk' => $produk]);
    }

    public function update(Request $request)
  {
  	DB::table('produk')->where('nama_produk',$request->nama_produk)->update([
  		'nama_produk' => $request->nama_produk,
  		'keterangan' => $request->keterangan,
  		'harga' => $request->harga,
  		'jumlah' => $request->jumlah
  	]);
  	return redirect('/produk');
  }


public function hapus($nama)
{

	DB::table('produk')->where('nama_produk',$nama)->delete();


	return redirect('/produk');
}
}
