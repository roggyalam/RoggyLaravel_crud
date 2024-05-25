<?php

namespace App\Http\Controllers;

use App\Models\Merek;
use Illuminate\Http\Request;




class MerekController extends Controller
{
    //   public function viewPDF()
    // {
    //     $merek = Merek::latest()->get();

    //     $data = [
    //         'title' => 'Data merek',
    //         'date' => date('m/d/Y'),
    //         'merek' => $merek,
    //     ];

    //     $pdf = PDF::loadView('merek.export-pdf', $data)
    //         ->setPaper('a4', 'portrait');
    //     return $pdf->stream();
    // }

    // menampilkan data

 public function index()
 {
  $merek = Merek::latest()->paginate(5);
  return view('merek.index', compact('merek'));
 }

//
 public function create()
 {
  return view('merek.create');
 }

 public function store(Request $request)
 {
  //validate form
  $this->validate($request, [
   'nama_merek'      => 'required|min:5',

  ]);

  $merek            = new Merek();
  $merek->nama_merek      = $request->nama_merek;
//   // upload image
//   $image = $request->file('image');
//   $image->storeAs('public/mereks', $image->hashName());
//   $merek->image = $image->hashName();
  $merek->save();
  return redirect()->route('merek.index');
 }

 public function show($id)
 {
  $merek = Merek::findOrFail($id);
  return view('merek.show', compact('merek'));
 }

 public function edit($id)
 {
  $merek = Merek::findOrFail($id);
  return view('merek.edit', compact('merek'));
 }

 public function update(Request $request, $id)
 {
  $this->validate($request, [
   'nama_merek'      => 'required|min:5',
  ]);

  $merek            = Merek::findOrFail($id);
  $merek->nama_merek      = $request->nama_merek;
//   // upload image
//   $image = $request->file('image');
//   $image->storeAs('public/mereks', $image->hashName());
//   //delete old image
//   Storage::delete('public/mereks/' . $merek->image);

//   $merek->image = $image->hashName();
  $merek->save();
  return redirect()->route('merek.index');

 }

 public function destroy($id)
 {
  $merek = Merek::findOrFail($id);
  Storage::delete('public/mereks/' . $merek->image);
  $merek->delete();
  return redirect()->route('merek.index');

 }
}
