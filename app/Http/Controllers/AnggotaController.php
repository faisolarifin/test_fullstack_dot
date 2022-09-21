<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnggotaSaveRequest;
use App\Models\Anggota;
use App\Models\KK;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnggotaController extends Controller
{
    public function index()
    {
        $kk = KK::all();
        $pekerjaan = Pekerjaan::all();
        $anggota = Anggota::with(["kk", "pekerjaan"])->get();
        return view('home', compact('anggota', 'kk', 'pekerjaan'));
    }

    public function saveAnggota(AnggotaSaveRequest $request)
    {
        DB::transaction(function() use ($request) {
            Anggota::create([
                'id_kk' => $request->no_kk,
                'id_pkj' => $request->pekerjaan,
                'nik' => $request->nik,
                'nama' => $request->nama,
                'jenkel' => $request->jenkel,
                'tmp_lahir' => $request->tmp_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'status_kawin' => $request->status_kawin,
                'nm_ayah' => $request->nm_ayah,
                'nm_ibu' => $request->nm_ibu,
            ]);
        });
        return response()->json([
            "status" => 200,
            'message' => "Berhasil menambahkan data anggota.",
        ]);
    }
    public function deleteAnggota(Anggota $anggota)
    {
        $anggota->delete();
        return response()->json([
            "status" => 200,
            'message' => "Berhasil menghapus data anggota.",
        ]);
    }
    public function getAnggota($id=null)
    {
        if ($id != null) {
            $res = Anggota::with(['kk', 'pekerjaan'])->find($id);
            return response()->json($res);
        }
        $res = Anggota::with(['kk', 'pekerjaan'])->get();
        return response()->json($res);
    }
    public function updateAnggota(Request $request, Anggota $anggota)
    {
        $anggota->update([
            'id_kk' => $request->no_kk,
            'id_pkj' => $request->pekerjaan,
            'nik' => $request->nik,
            'nama' => $request->nama,
            'jenkel' => $request->jenkel,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'status_kawin' => $request->status_kawin,
            'nm_ayah' => $request->nm_ayah,
            'nm_ibu' => $request->nm_ibu,
        ]);
        return response()->json([
            "status" => 200,
            'message' => "Berhasil mengubah data anggota.",
        ]);
    }
}
