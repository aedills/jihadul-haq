<?php

namespace App\Http\Controllers;

use App\Models\MJamaah;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class JamaahController extends Controller
{
    public function index(Request $request)
    {
        if(!session('data')){
            return redirect()->route('log1n')->with('error', 'Anda harus login terlebih dahulu');
        }

        return view('admin/jamaah/index', [
            'title' => 'Data Jamaah | Admin',
            'page' => 'Data Jamaah',
            'path' => 'Data Jamaah',
            'jamaah' => MJamaah::all(),

            'l' => MJamaah::where('gender', 'l')->count(),
            'p' => MJamaah::where('gender', 'p')->count(),
            'total' => MJamaah::count(),

            'role' => session('data')->role
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_jamaah' => 'string|required',
                'alamat' => 'string|required',
                'no_hp' => 'string|required|unique:data_jamaah,no_hp',
                'gender' => 'string|required|max:1',
                'tempat_lahir' => 'string|nullable',
                'tanggal_lahir' => 'date|nullable',
                'pekerjaan' => 'string|nullable',
            ]);

            $jamaah = new MJamaah();

            $birth_date = Carbon::parse($request->tanggal_lahir);

            $jamaah->nama = $request->nama_jamaah;
            $jamaah->alamat = $request->alamat;
            $jamaah->no_hp = $request->no_hp;
            $jamaah->p4ss = Hash::make($request->tanggal_lahir);
            $jamaah->gender = $request->gender;
            $jamaah->tempat_lahir = $request->tempat_lahir;
            $jamaah->tanggal_lahir = $request->tanggal_lahir;
            $jamaah->umur = $birth_date->age;
            $jamaah->pekerjaan = $request->pekerjaan;

            $jamaah->save();

            return back()->with('success', 'Berhasil menambahkan data');
        } catch (ValidationException $e) {
            return back()->with('error', 'Gagal menambahkan data, No. Hp/Wa telah digunakan atau kesalahan lainnya.');
        } catch (\Exception $err) {
            return back()->with('error', 'Gagal menambahkan data');
        }
    }

    public function edit(Request $request, $id)
    {
        if(!session('data')){
            return redirect()->route('log1n')->with('error', 'Anda harus login terlebih dahulu');
        }
        return view('admin/jamaah/edit', [
            'title' => 'Edit Data Jamaah | Admin',
            'page' => 'Edit Data Jamaah',
            'path' => 'Edit / Data Jamaah',
            'jamaah' => MJamaah::findOrFail($id),

            'role' => session('data')->role
        ]);
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'id' => 'string|required',
                'nama_jamaah' => 'string|required',
                'alamat' => 'string|required',
                'gender' => 'string|required|max:1',
                'tempat_lahir' => 'string|nullable',
                'tanggal_lahir' => 'date|nullable',
                'pekerjaan' => 'string|nullable',
            ]);

            $jamaah = MJamaah::findOrFail($request->id);

            $jamaah->nama = $request->nama_jamaah;
            $jamaah->alamat = $request->alamat;
            $jamaah->gender = $request->gender;
            $jamaah->tempat_lahir = $request->tempat_lahir;
            $jamaah->tanggal_lahir = $request->tanggal_lahir;
            $jamaah->pekerjaan = $request->pekerjaan;

            $jamaah->save();

            return redirect()->route('admin.jamaah.index')->with('success', 'Berhasil memperbarui data');
        } catch (ValidationException $e) {
            return redirect()->route('admin.jamaah.index')->with('error', 'Gagal memperbarui data, No. Hp/Wa telah digunakan atau kesalahan lainnya.');
        } catch (\Exception $err) {
            return redirect()->route('admin.jamaah.index')->with('error', 'Gagal memperbarui data');
        }
    }

    public function delete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer'
            ]);

            $jamaah = MJamaah::where('id', $request->id)->first();

            if (!$jamaah) {
                return back()->with('error', 'Data tidak ditemukan');
            }

            $status = $jamaah->delete();

            if ($status) {
                return back()->with('success', 'Berhasil menghapus data');
            } else {
                return back()->with('error', 'Gagal menghapus data');
            }
        } catch (\Exception $err) {
            return back()->with('error', 'Terdapat kesalahan dalam menghapus data');
        }
    }
}
