<?php

namespace App\Http\Controllers;

use App\Models\MIncome;
use App\Models\MJamaah;
use App\Models\MKegiatan;
use App\Models\MOutcome;
use App\Models\MQurban;
use App\Models\MQurbanDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function home(Request $request)
    {
        $now = Carbon::now();
        $startDate = $now;

        // Total Kas
        $x = MIncome::all()->sum('nominal');
        $y = MOutcome::all()->sum('nominal');
        $kas = $x - $y;

        switch ($request->range) {
            case '1week':
                $startDate = $now->subWeek();
                $ket = 'pekan ini';
                break;
            case '2week':
                $startDate = $now->subWeeks(2);
                $ket = 'dua pekan';
                break;
            case '1month':
                $startDate = $now->startOfMonth();
                $ket = 'bulan ini';
                break;
            case '3month':
                $startDate = $now->subMonths(3);
                $ket = 'tiga bulan';
                break;
            case '6month':
                $startDate = $now->subMonths(6);
                $ket = 'enam bulan';
                break;
            case '1year':
                $startDate = $now->subYear();
                $ket = 'tahun ini';
                break;
            default:
                $startDate = $now->startOfMonth();
                $ket = 'bulan ini';
                break;
        }

        return view('user/home', [
            'title' => 'Dashboard | Jihadul Haq',
            'page' => 'Dashboard',
            'path' => 'Dashboard',

            'range' => $request->range ? $request->range : '1month',
            'ket' => $ket,

            'totalIn' => MIncome::where('tanggal', '>=', $startDate)->sum('nominal'),
            'totalOut' => MOutcome::where('tanggal', '>=', $startDate)->sum('nominal'),
            'totalKas' => $kas,

            'totalJamaah' => MJamaah::count()
        ]);
    }

    public function qurban()
    {
        if (!session('data')) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu');
        }

        return view('user/qurban', [
            'title' => 'Data Qurban | Jihadul Haq',
            'page' => 'Data Qurban',
            'path' => 'Data Qurban',
            'qurban' => MQurban::withSum('detail', 'nominal')->where('nama_penanggungjawab', 'LIKE', session('data')->nama)->get()
        ]);
    }

    public function qurbanDetail($id)
    {
        if (!session('data')) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu');
        }

        return view('user/qurbanDetail', [
            'title' => 'Data Qurban | Admin',
            'page' => 'Detail Data Qurban',
            'path' => 'Data Qurban / Detail',

            'id_q' => $id,
            'qurban' => MQurban::findOrFail($id),
            'detail' => MQurbanDetail::where('id_qurban', $id)->orderBy('tgl_bayar', 'desc')->get(),
            'terbayar' => MQurbanDetail::where('id_qurban', $id)->sum('nominal')
        ]);
    }

    public function kegiatan()
    {
        return view('user/kegiatan', [
            'title' => 'Kegiatan | Jihadul Haq',
            'page' => 'Kegiatan',
            'path' => 'Kegiatan',
            'kegiatan' => MKegiatan::orderBy('tanggal_mulai', 'asc')->get()
        ]);
    }

    public function keuangan()
    {
        $StartOfMonth = Carbon::now()->startOfMonth();
        $StartOfWeek = Carbon::now()->startOfWeek();

        return view('user/keuangan', [
            'title' => 'Data Keuangan | Jihadul Haq',
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

    public function jamaah()
    {
        return view('user/jamaah', [
            'title' => 'Data Jamaah | Jihadul Haq',
            'page' => 'Data Jamaah',
            'path' => 'Data Jamaah',

            'jamaah' => MJamaah::all(),

            'l' => MJamaah::where('gender', 'l')->count(),
            'p' => MJamaah::where('gender', 'p')->count(),
            'total' => MJamaah::count()
        ]);
    }
}
