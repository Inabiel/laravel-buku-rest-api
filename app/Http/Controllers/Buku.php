<?php

namespace App\Http\Controllers;

use App\Models\Buku as ModelsBuku;
use App\Http\Requests\BookRequest;


class Buku extends Controller
{
    public function store(BookRequest $request){
        $insert = ModelsBuku::create($request->all());

        return response()->json([
            'message' => 'Data terisi',
            'data' => $insert
        ],200);
    }

    public function readAll(){
        $datas = ModelsBuku::with('categories:id,nama')->get();
        if($datas->isEmpty()){
            return response()->json([
                'message' => 'Data Masih Kosong..'
            ],400);
        }
        return response()->json([
            'data' => $datas
        ],200);
    }

    public function readFromId($id){
        $datas = ModelsBuku::firstWhere('id',$id);
        if(!$datas){
            return response()->json([
                'message' => 'Data tidak ditemukan...'
            ],400);
        }
        return response()->json([
            'data' => $datas
        ],200);
    }

    public function updateFromId(BookRequest $request, $id) {
        $datas = ModelsBuku::where('id', $id)->first();
        $datas->update($request->all());
        if(!$datas){
            return response()->json([
                'sukses' => 'Tidak',
                'msg'    => 'Data Tidak Berhasil Diedit'
            ]);
        }

        return response()->json([
            'sukses' => 'Ya',
            'msg'    => 'Data Berhasil Diedit'
        ]);

    }

    public function delete($id) {
        $isDataAvailable = ModelsBuku::where('id', $id)->first();

        if(!$isDataAvailable){
            return response()->json([
                'sukses' => 'Tidak',
                'msg'    => 'Data Tidak Ditemukan'
            ], 400);
        }

        $deleteData = $isDataAvailable->delete();
        if(!$deleteData){
            return response()->json([
                'sukses' => 'Ya',
                'msg'    => 'Data Tidak Berhasil Berhasil Dihapus'
            ]);
        }

        return response()->json([
            'sukses' => 'Ya',
            'msg'    => "Data dengan ID $id dan nama buku $isDataAvailable->judul Berhasil Berhasil Dihapus"
        ]);
    }
}
