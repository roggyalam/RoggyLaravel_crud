<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
      public function viewPDF()
    {
        $barang = Barang::latest()->get();

        $data = [
            'title' => 'Data Barang',
            'date' => date('m/d/Y'),
            'barang' => $barang,
        ];

        $pdf = PDF::loadView('barang.export-pdf', $data)
            ->setPaper('a4', 'portrait');
        return $pdf->stream();
    }


 public function index()
 {
  $barang = Barang::latest()->paginate(5);
  return view('barang.index', compact('barang'));
 }

 public function create()
 {
  return view('barang.create');
 }

 public function store(Request $request)
 {
  //validate form
  $this->validate($request, [
   'nama_barang'      => 'required|min:5',
   'harga'     => 'required',
   'stok'     => 'required',
   'merek_id' => 'required',
  ]);

  $barang            = new Barang();
  $barang->nama_barang      = $request->nama_barang;
  $barang->harga     = $request->harga;
  $barang->stok = $request->stok;
  $barang->merek_id = $request->merek_id;
//   // upload image
//   $image = $request->file('image');
//   $image->storeAs('public/barangs', $image->hashName());
//   $barang->image = $image->hashName();
  $barang->save();
  return redirect()->route('barang.index');
 }

 public function show($id)
 {
  $barang = Barang::findOrFail($id);
  return view('barang.show', compact('barang'));
 }

 public function edit($id)
 {
  $barang = Barang::findOrFail($id);
  return view('barang.edit', compact('barang'));
 }

 public function update(Request $request, $id)
 {
  $this->validate($request, [
   'nama_barang'      => 'required|min:5',
   'harga'     => 'required|min:1',
   'stok'     => 'required|min:1',
   'merek_id' => 'required',
  ]);

  $barang            = Barang::findOrFail($id);
  $barang->nama_barang      = $request->nama_barang;
  $barang->harga     = $request->harga;
  $barang->stok = $request->stok;
  $barang->merek_id = $request->merek_id;
//   // upload image
//   $image = $request->file('image');
//   $image->storeAs('public/barangs', $image->hashName());
//   //delete old image
//   Storage::delete('public/barangs/' . $barang->image);

//   $barang->image = $image->hashName();
  $barang->save();
  return redirect()->route('barang.index');

 }

 public function destroy($id)
 {
  $barang = Barang::findOrFail($id);
  Storage::delete('public/barangs/' . $barang->image);
  $barang->delete();
  return redirect()->route('barang.index');

 }
}
