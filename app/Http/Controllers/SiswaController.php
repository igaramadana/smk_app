<?php

namespace App\Http\Controllers;

use App\Models\KelasModel;
use App\Models\SiswaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    public function index()
    {
        $kelas = KelasModel::all();
        return view('admin.datamaster.siswa', compact('kelas'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nis' => 'required|min:4|unique:siswa,nis',
            'nama_siswa' => 'required|min:3',
            'jenis_kelamin' => 'required',
            'id_kelas' => 'required|exists:kelas,id',
            'alamat' => 'required',
            'no_wa' => 'required|numeric|min:10'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            SiswaModel::create($request->all());
            return redirect()->back()->with('success', 'Data siswa berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nis' => 'required|min:4|unique:siswa,nis,' . $id,
            'nama_siswa' => 'required|min:3',
            'jenis_kelamin' => 'required',
            'id_kelas' => 'required|exists:kelas,id',
            'alamat' => 'required',
            'no_wa' => 'required|numeric|min:10'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $siswa = SiswaModel::find($id);
            $siswa->update($request->all());
            return redirect()->back()->with('success', 'Data siswa berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
