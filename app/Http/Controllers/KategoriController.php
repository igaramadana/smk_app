<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriModel;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index()
    {
        return view('admin.pembayaran.kategori');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|string|max:255|min:3|unique:kategori,nama_kategori',
            'nominal' => 'required|numeric|min:1000'
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi',
            'nama_kategori.min' => 'Nama kategori minimal 3 karakter',
            'nama_kategori.unique' => 'Nama kategori sudah digunakan',
            'nominal.required' => 'Nominal wajib diisi',
            'nominal.min' => 'Nominal minimal Rp 1.000'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->with('error', $validator->errors()->first())
                ->withInput();
        }

        try {
            KategoriModel::create([
                'nama_kategori' => $request->nama_kategori,
                'nominal' => $request->nominal
            ]);
            return redirect()->route('kategori.index')
                ->with('success', 'Data kategori berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Data kategori gagal ditambahkan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|string|max:255|min:3|unique:kategori,nama_kategori,' . $id,
            'nominal' => 'required|numeric|min:1000'
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi',
            'nama_kategori.min' => 'Nama kategori minimal 3 karakter',
            'nama_kategori.unique' => 'Nama kategori sudah digunakan',
            'nominal.required' => 'Nominal wajib diisi',
            'nominal.min' => 'Nominal minimal Rp 1.000'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->with('error', $validator->errors()->first())
                ->withInput();
        }

        try {
            $kategori = KategoriModel::findOrFail($id);

            if (!$kategori) {
                return redirect()->back()
                    ->with('error', 'Data kategori tidak ditemukan')
                    ->withInput();
            }

            $kategori->update([
                'nama_kategori' => $request->nama_kategori,
                'nominal' => $request->nominal
            ]);

            return redirect()->route('kategori.index')
                ->with('success', 'Data kategori berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui data kategori: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function delete(string $id)
    {
        try {
            $check = KategoriModel::find($id);
            if (!$check) {
                return redirect()->back()->with('error', 'Data kategori tidak ditemukan');
            }

            KategoriModel::destroy($id);
            return redirect()->route('kategori.index')->with('success', 'Data kategori berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data kategori tidak dapat dihapus karena masih terdapat pembayaran yang memakai kategori ini.');
        }
    }
}
