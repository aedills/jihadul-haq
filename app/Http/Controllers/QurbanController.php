<?php

namespace App\Http\Controllers;

use App\Models\MQurban;
use App\Models\MQurbanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QurbanController extends Controller
{
    public function index()
    {
        return view('admin/qurban/index', [
            'title' => 'Data Qurban | Admin',
            'page' => 'Data Qurban',
            'path' => 'Data Qurban',
            'qurban' => MQurban::withSum('detail', 'nominal')->get()
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'penanggung_jawab' => 'required|string|max:100',
                'tgl_mulai' => 'required|date',
                'total_target' => 'required|string',
            ]);

            $qurban = new MQurban();

            $qurban->nama_penanggungjawab = $request->penanggung_jawab;
            $qurban->status = 'Belum Lunas';
            $qurban->tgl_mulai = $request->tgl_mulai;
            $qurban->total_target = $request->total_target;

            $qurban->save();

            return back()->with('success', 'Berhasil menambahkan data');
        } catch (\Exception $err) {
            return back()->with('error', 'Terdapat kesalahan saat menambahkan data');
        }
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|string',
                'penanggung_jawab' => 'required|string|max:100',
                'tgl_mulai' => 'required|date',
                'total_target' => 'required|string',
            ]);

            $qurban = MQurban::find($request->id);

            $qurban->nama_penanggungjawab = $request->penanggung_jawab;
            $qurban->tgl_mulai = $request->tgl_mulai;
            $qurban->total_target = $request->total_target;

            $qurban->save();

            $this->updateStatus($request->id);

            return back()->with('success', 'Berhasil memperbarui data');
        } catch (\Exception $err) {
            return back()->with('error', 'Terdapat kesalahan saat memperbarui data');
        }
    }

    public function delete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|string'
            ]);

            DB::beginTransaction();

            $qurban = MQurban::find($request->id);
            if ($qurban) {
                $qurban->delete();
                MQurbanDetail::where('id_qurban', $request->id)->delete();

                DB::commit();

                return back()->with('success', 'Berhasil menghapus data');
            } else {
                DB::rollBack();
            }
        } catch (\Exception $err) {
            return back()->with('error', 'Terdapat kesalahan saat menghapus data');
        }
    }

    public function detail($id)
    {
        return view('admin/qurban/detail', [
            'title' => 'Data Qurban | Admin',
            'page' => 'Detail Data Qurban',
            'path' => 'Data Qurban / Detail',
            'id_q' => $id,
            'qurban' => MQurban::findOrFail($id),
            'detail' => MQurbanDetail::where('id_qurban', $id)->orderBy('tgl_bayar', 'desc')->get(),
            'terbayar' => MQurbanDetail::where('id_qurban', $id)->sum('nominal')
        ]);
    }

    public function detailCreate(Request $request)
    {
        try {
            $request->validate([
                'id_q' => 'required|string',
                'nama_pembayar' => 'required|string|max:100',
                'tgl_bayar' => 'required|date',
                'nominal' => 'required|string'
            ]);

            $detail = new MQurbanDetail();

            $detail->id_qurban = $request->id_q;
            $detail->nama_pembayar = $request->nama_pembayar;
            $detail->tgl_bayar = $request->tgl_bayar;
            $detail->nominal = $request->nominal;

            $detail->save();

            $this->updateStatus($request->id_q);

            return back()->with('success', 'Berhasil menambahkan data');
        } catch (\Exception $err) {
            return back()->with('error', 'Terdapat kesalahan saat menambahkan data');
        }
    }

    public function detailUpdate(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|string',
                'id_q' => 'required|string',
                'nama_pembayar' => 'required|string|max:100',
                'tgl_bayar' => 'required|date',
                'nominal' => 'required|string'
            ]);

            $detail = MQurbanDetail::find($request->id);

            $detail->nama_pembayar = $request->nama_pembayar;
            $detail->tgl_bayar = $request->tgl_bayar;
            $detail->nominal = $request->nominal;

            $detail->save();

            $this->updateStatus($detail->id_qurban);

            return back()->with('success', 'Berhasil memperbarui data');
        } catch (\Exception $err) {
            // dd($err);
            return back()->with('error', 'Terdapat kesalahan saat memperbarui data');
        }
    }

    public function detailDelete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|string',
                'idq' => 'required|string'
            ]);

            $detail = MQurbanDetail::find($request->id);

            if ($request->idq == $detail->id_qurban) {
                $detail->delete();

                $this->updateStatus($detail->id_qurban);
            } else {
                return back()->with('error', 'Terdapat kesalahan saat menghapus data');
            }

            return back()->with('success', 'Berhasil menghapus data');
        } catch (\Exception $err) {
            return back()->with('error', 'Terdapat kesalahan saat menghapus data');
        }
    }

    protected function updateStatus($id)
    {
        $data = MQurban::withSum('detail', 'nominal')->where('id', $id)->firstOrFail();
        if ($data->detail_sum_nominal >= $data->total_target) {
            $data->status = 'Lunas';
        } else {
            $data->status = 'Belum Lunas';
        }

        $data->save();
    }
}
