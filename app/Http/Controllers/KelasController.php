<?php

namespace App\Http\Controllers;

use App\Models\KelasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    public function index()
    {
        return view('admin.datamaster.kelas');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_kelas' => 'required|min:2|max:3|unique:kelas,nama_kelas'
            ]);

            KelasModel::create([
                'nama_kelas' => $request->nama_kelas
            ]);

            return redirect()->route('kelas.index')->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_kelas' => 'required|min:2|max:8|unique:kelas,nama_kelas,'.$id
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        try {
            $kelas = KelasModel::findOrFail($id);

            $kelas->update([
                'nama_kelas' => $request->nama_kelas
            ]);

            return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete(string $id)
    {
        $check = KelasModel::find($id);
        if (!$check) {
            return redirect()->back()->with('error', 'Data kelas tidak ditemukan');
        }

        try {
            KelasModel::destroy($id);
            return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
