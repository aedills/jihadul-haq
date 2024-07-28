<?php

namespace App\Http\Controllers;

use App\Models\MIncome;
use App\Models\MJamaah;
use App\Models\MOutcome;
use App\Models\MQurban;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request, $range = '1month')
    {
        if(!session('data')){
            return redirect()->route('log1n')->with('error', 'Anda harus login terlebih dahulu');
        }
        
        $now = Carbon::now();
        $startDate = $now;

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

        // Total Kas
        $x = MIncome::all()->sum('nominal');
        $y = MOutcome::all()->sum('nominal');
        $kas = $x - $y;

        $incomeData = MIncome::where('tanggal', '>=', $startDate)
            ->selectRaw('tanggal, SUM(nominal) as total_nominal')
            ->groupBy('tanggal')
            ->get();

        $outcomeData = MOutcome::where('tanggal', '>=', $startDate)
            ->selectRaw('tanggal, SUM(nominal) as total_nominal')
            ->groupBy('tanggal')
            ->get();

        $incomeArray = $incomeData->mapWithKeys(function ($item) {
            return [$item['tanggal'] => $item['total_nominal']];
        })->toArray();

        $outcomeArray = $outcomeData->mapWithKeys(function ($item) {
            return [$item['tanggal'] => $item['total_nominal']];
        })->toArray();

        $allDates = array_unique(array_merge(array_keys($incomeArray), array_keys($outcomeArray)));
        sort($allDates);

        $incomeFinal = [];
        $outcomeFinal = [];

        foreach ($allDates as $date) {
            $incomeFinal[] = isset($incomeArray[$date]) ? $incomeArray[$date] : 0;
            $outcomeFinal[] = isset($outcomeArray[$date]) ? $outcomeArray[$date] : 0;
        }

        return view('admin/dashboard', [
            'title' => 'Dashboard | Jihadul Haq',
            'page' => 'Dashboard',
            'path' => 'Dashboard',

            'range' => $request->range ? $request->range : '1month',
            'ket' => $ket,

            'totalIn' => MIncome::where('tanggal', '>=', $startDate)->sum('nominal'),
            'in' => $incomeData,
            'totalOut' => MOutcome::where('tanggal', '>=', $startDate)->sum('nominal'),
            'out' => $outcomeData,
            
            'allDates' => $allDates,
            'incomeFinal' => $incomeFinal,
            'outcomeFinal' => $outcomeFinal,

            'totalKas' => $kas,
            'totalJamaah' => MJamaah::count(),
            'qurban' => MQurban::withSum('detail', 'nominal')->orderBy('updated_at', 'desc')->get(),

            'role' => session('data')->role
        ]);
    }
}
