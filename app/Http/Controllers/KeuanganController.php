<?php

namespace App\Http\Controllers;

use App\Models\MIncome;
use App\Models\MOutcome;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    public function index(Request $request)
    {
        $StartOfMonth = Carbon::now()->startOfMonth();
        $StartOfWeek = Carbon::now()->startOfWeek();

        return view('admin/keuangan/index', [
            'title' => 'Data Keuangan | Admin',
            'page' => 'Data Keuangan',
            'path' => 'Data Keuangan',

            'income' => MIncome::orderBy('tanggal', 'desc')->get(),
            'totalMonthIn' => MIncome::where('tanggal', '>=', $StartOfMonth)->sum('nominal'),
            'totalWeekIn' => MIncome::where('tanggal', '>=', $StartOfWeek)->sum('nominal'),

            'outcome' => MOutcome::orderBy('tanggal', 'desc')->get(),
            'totalMonthOut' => MOutcome::where('tanggal', '>=', $StartOfMonth)->sum('nominal'),
            'totalWeekOut' => MOutcome::where('tanggal', '>=', $StartOfWeek)->sum('nominal'),
        ]);
    }

    // Income
    public function storeIn(Request $request)
    {
        $request->validate([
            'jenis_pemasukan' => 'required|string',
            'tanggal_in' => 'required|date',
            'nominal_in' => 'required',
            'sumber_pemasukan' => 'required|string',
            'keterangan_in' => 'nullable|string',
        ]);

        try {
            $income = new MIncome();

            $income->jenis_pemasukan = $request->jenis_pemasukan;
            $income->tanggal = $request->tanggal_in;
            $income->nominal = $request->nominal_in;
            $income->sumber_pemasukan = $request->sumber_pemasukan;
            $income->keterangan = $request->keterangan_in;

            $income->save();

            return back()->with('success', 'Berhasil menambahkan data');
        } catch (\Exception $err) {
            return back()->with('error', 'Terdapat kesalahan dalam menambahkan data');
        }
    }

    public function updateIn(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required',
                'jenis_pemasukan' => 'required|string',
                'tanggal_in' => 'required|date',
                'nominal_in' => 'required',
                'sumber_pemasukan' => 'required|string',
                'keterangan_in' => 'nullable|string',
            ]);

            $income = MIncome::find($request->id);

            $income->jenis_pemasukan = $request->jenis_pemasukan;
            $income->tanggal = $request->tanggal_in;
            $income->nominal = $request->nominal_in;
            $income->sumber_pemasukan = $request->sumber_pemasukan;
            $income->keterangan = $request->keterangan_in;

            $income->save();

            return back()->with('success', 'Berhasil memperbarui data');
        } catch (\Exception $err) {
            return back()->with('error', 'Terdapat kesalahan dalam memperbarui data');
        }
    }

    public function deleteIn(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required'
            ]);

            $income = MIncome::find($request->id);

            $income->delete();

            return back()->with('success', 'Berhasil menghapus data');
        } catch (\Exception $err) {
            return back()->with('error', 'Terdapat kesalahan dalam menghapus data');
        }
    }


    // Outcome
    public function storeOut(Request $request)
    {
        $request->validate([
            'jenis_pengeluaran' => 'required|string',
            'tanggal_out' => 'required|date',
            'nominal_out' => 'required',
            'tujuan_pengeluaran' => 'required|string',
            'keterangan_out' => 'nullable|string',
        ]);

        try {
            $outcome = new MOutcome();

            $outcome->jenis_pengeluaran = $request->jenis_pengeluaran;
            $outcome->tanggal = $request->tanggal_out;
            $outcome->nominal = $request->nominal_out;
            $outcome->tujuan_pengeluaran = $request->tujuan_pengeluaran;
            $outcome->keterangan = $request->keterangan_out;

            $outcome->save();

            return back()->with('success', 'Berhasil menambahkan data');
        } catch (\Exception $err) {
            return back()->with('error', 'Terdapat kesalahan dalam menambahkan data');
        }
    }

    public function updateOut(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required',
                'jenis_pengeluaran' => 'required|string',
                'tanggal_out' => 'required|date',
                'nominal_out' => 'required',
                'tujuan_pengeluaran' => 'required|string',
                'keterangan_out' => 'nullable|string',
            ]);

            $outcome = MOutcome::find($request->id);

            $outcome->jenis_pengeluaran = $request->jenis_pengeluaran;
            $outcome->tanggal = $request->tanggal_out;
            $outcome->nominal = $request->nominal_out;
            $outcome->tujuan_pengeluaran = $request->tujuan_pengeluaran;
            $outcome->keterangan = $request->keterangan_out;

            $outcome->save();

            return back()->with('success', 'Berhasil memperbarui data');
        } catch (\Exception $err) {
            return back()->with('error', 'Terdapat kesalahan dalam memperbarui data');
        }
    }

    public function deleteOut(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required'
            ]);

            $outcome = MOutcome::find($request->id);

            $outcome->delete();

            return back()->with('success', 'Berhasil menghapus data');
        } catch (\Exception $err) {
            return back()->with('error', 'Terdapat kesalahan dalam menghapus data');
        }
    }
}
