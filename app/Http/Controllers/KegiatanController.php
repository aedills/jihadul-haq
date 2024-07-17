<?php

namespace App\Http\Controllers;

use App\Models\MKegiatan;
use Exception;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        return view('admin/kegiatan/index', [
            'title' => 'Data Kegiatan | Admin',
            'page' => 'Data Kegiatan',
            'path' => 'Data Kegiatan',
            'kegiatan' => MKegiatan::all()
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_kegiatan' => 'required|string|max:200',
                'keterangan' => 'required|string',
                'tgl_mulai' => 'required|date',
                'tgl_selesai' => 'date|nullable',
                'lokasi' => 'required|string',
                'pj' => 'required|string',
                'status' => 'required|string',
            ]);

            $kegiatan = new MKegiatan();

            $kegiatan->nama_kegiatan = $request->nama_kegiatan;
            $kegiatan->keterangan = $request->keterangan;
            $kegiatan->tanggal_mulai = $request->tgl_mulai;
            $kegiatan->tanggal_selesai = $request->tgl_selesai;
            $kegiatan->lokasi = $request->lokasi;
            $kegiatan->penanggung_jawab = $request->pj;
            $kegiatan->status = $request->status;

            $kegiatan->save();

            return back()->with('success', 'Berhasil menambahkan data');
        } catch (\Exception $err) {
            return back()->with('error', 'Gagal menambahkan data');
        }
    }

    public function edit(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer'
            ]);

            $kegiatan = MKegiatan::where('id', $request->id)->first();
            if (!$kegiatan) {
                return back()->with('error', 'Data tidak ditemukan');
            }

            return view('admin/kegiatan/edit', [
                'title' => 'Data Kegiatan | Admin',
                'page' => 'Edit Data Kegiatan',
                'path' => 'Data Kegiatan / Edit',
                'kegiatan' => $kegiatan
            ]);
        } catch (\Exception $err) {
            return back()->with('error', 'Gagal mengambil data');
        }
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer',
                'nama_kegiatan' => 'required|string|max:200',
                'keterangan' => 'required|string',
                'tgl_mulai' => 'required|date',
                'tgl_selesai' => 'date|nullable',
                'lokasi' => 'required|string',
                'pj' => 'required|string',
                'status' => 'required|string',
            ]);

            $kegiatan = MKegiatan::where('id', $request->id)->first();

            if (!$kegiatan) {
                return back()->with('error', 'Data tidak ditemukan');
            }

            $kegiatan->nama_kegiatan = $request->nama_kegiatan;
            $kegiatan->keterangan = $request->keterangan;
            $kegiatan->tanggal_mulai = $request->tgl_mulai;
            $kegiatan->tanggal_selesai = $request->tgl_selesai;
            $kegiatan->lokasi = $request->lokasi;
            $kegiatan->penanggung_jawab = $request->pj;
            $kegiatan->status = $request->status;

            $kegiatan->save();

            return back()->with('success', 'Berhasil memperbarui data');
        } catch (\Exception $err) {
            return back()->with('error', 'Terdapat kesalahan dalam memperbarui data');
        }
    }

    public function delete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer'
            ]);

            $kegiatan = MKegiatan::where('id', $request->id)->first();

            if (!$kegiatan) {
                return back()->with('error', 'Data tidak ditemukan');
            }

            $status = $kegiatan->delete();
            if ($status) {
                return back()->with('success', 'Berhasil menghapus data');
            } else {
                return back()->with('error', 'Gagal menghapus data');
            }
        } catch (\Exception $err) {

            dd($err);
            return back()->with('error', 'Terdapat kesalahan dalam menghapus data');
        }
    }
}
