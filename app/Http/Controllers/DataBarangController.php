<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use App\Barang;

class DataBarangController extends Controller
{
    public function GetDataBarang()
    {
        $data = Barang::all();
        if($data) {
            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Diambil',
                'data'    => $data
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Gagal Diambil',
                'data'    => ''
            ], 400);
        }
    }

    public function TambahDataBarang(Request $request)
    {
        $nama       = $request->input('nama');
        $harga      = $request->input('harga');
        $deskripsi  = $request->input('deskripsi');

        $this->validate($request, [
            'nama'  => 'required|min:5|max:30',
            'harga' => 'required',
            'img'   => 'nullable|image|mimes:jpg,jpeg,png',
            'deskripsi'  => 'required|min:10',
        ]);

        if ($request->hasFile('img')) {
            $filename = Str::random(10) . $request->nama . '.jpg';

            $file = $request->file('img');

            $file->move(base_path('public/images'), $filename);
        }   

        $data = Barang::create([
            'nama'      => $nama,
            'harga'     => $harga,
            'img'       => $filename,
            'deskripsi' => $deskripsi
        ]);

        if($data) {
            $out = [
                'message'   => 'Data Berhasil Disimpan',
                'code'      => 200
            ];
        } else {
            $out = [
                'message'   => 'Data Gagal Disimpan',
                'code'      => 403
            ];
        }

        $path = $request->path;
        return redirect($path);
    }

    public function HapusBarang(Request $request, $id)
    {
        $data = Barang::findOrFail($id);
        $data->delete();

        if($data) {
            $out = [
                'message'   => 'Data Berhasil Dihapus',
                'code'      => 200
            ];
        } else {
            $out = [
                'message'   => 'Data Gagal Dihapus',
                'code'      => 403
            ];
        }

        $path = $request->path;
        return redirect($path);
    }
}