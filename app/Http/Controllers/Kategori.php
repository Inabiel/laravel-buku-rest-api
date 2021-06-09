<?php

namespace App\Http\Controllers;

use App\Http\Requests\KategoriRequest;
use App\Models\Kategori as ModelsKategori;

class Kategori extends Controller
{
    public function store(KategoriRequest $request)
    {
        $isDataExists = ModelsKategori::find($request->id);
        if(!$isDataExists){
            $insert = ModelsKategori::create($request->all());
            return response()->json([
                'message' => 'Data terisi',
                'data' => $insert
            ], 200);
        }
        return response()->json([
            'message' => 'Data Sudah Ada di Dalam Database',
        ], 500);
    }

    public function read()
    {
        $datas = ModelsKategori::with('books')->get();
        if ($datas->isEmpty()) {
            return response()->json([
                'message' => 'Data Masih Kosong..'
            ], 400);
        }
        return response()->json([
            'data' => $datas
        ], 200);
    }

    public function readFromId($id)
    {
        $datas = ModelsKategori::firstWhere('id', $id);
        if (!$datas) {
            return response()->json([
                'message' => 'Data tidak ditemukan...'
            ], 400);
        }
        return response()->json([
            'data' => $datas
        ], 200);
    }

    public function updateFromId(KategoriRequest $request, $id)
    {
        $datas = ModelsKategori::where('id', $id)->first();
        $datas->update($request->all());
        if (!$datas) {
            return response()->json([
                'sukses' => 'Tidak',
                'msg'    => 'Data Tidak Ditemukan'
            ]);
        }

        return response()->json([
            'sukses' => 'Ya',
            'msg'    => 'Data Berhasil Diedit'
        ]);
    }

    public function delete($id)
    {
        $isDataAvailable = ModelsKategori::where('id', $id)->first();

        if (!$isDataAvailable) {
            return response()->json([
                'sukses' => 'Tidak',
                'msg'    => 'Data Tidak Ditemukan'
            ], 400);
        }

        $deleteData = $isDataAvailable->delete();
        if (!$deleteData) {
            return response()->json([
                'sukses' => 'Ya',
                'msg'    => 'Data Tidak Berhasil Berhasil Dihapus'
            ]);
        }

        return response()->json([
            'sukses' => 'Ya',
            'msg'    => "Data dengan ID $id dan nama kategori $isDataAvailable->nama Berhasil Berhasil Dihapus"
        ]);
    }

}
