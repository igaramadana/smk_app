<?php

namespace App\Http\Controllers;

use App\Models\KelasModel;
use App\Models\SiswaModel;
use App\Imports\SiswaImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ImportSiswaRequest;
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

    public function import(ImportSiswaRequest $request)
    {
        try {
            $file = $request->file('file');
            $import = new SiswaImport();

            Excel::import($import, $file);

            $failures = $import->failures();
            $errors = $import->errors();

            if (count($failures) > 0 || count($errors) > 0) {
                $errorMessages = [];

                foreach ($failures as $failure) {
                    $errorMessages[] = "Baris {$failure->row()}: " . implode(', ', $failure->errors());
                }

                foreach ($errors as $error) {
                    $errorMessages[] = $error->getMessage();
                }

                return redirect()
                    ->back()
                    ->with('import_errors', $errorMessages)
                    ->with('import_failures', $failures)
                    ->withInput();
            }

            return redirect()
                ->back()
                ->with('success', 'Data siswa berhasil diimport!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function downloadTemplate()
    {
        $filePath = public_path('templates/template_import_siswa.xlsx');

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File template tidak ditemukan');
        }

        return response()->download($filePath);
    }

    public function delete(string $id)
    {
        try {
            $siswa = SiswaModel::find($id);
            $siswa->delete();
            return redirect()->back()->with('success', 'Data siswa berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
