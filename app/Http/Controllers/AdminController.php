<?php

namespace App\Http\Controllers;

use App\Models\MIncome;
use App\Models\MOutcome;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request, $range = '1month')
    {
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

        // Fetch income and outcome data based on the selected date range
        $incomeData = MIncome::where('tanggal', '>=', $startDate)->select('tanggal', 'nominal')->get();
        $outcomeData = MOutcome::where('tanggal', '>=', $startDate)->select('tanggal', 'nominal')->get();

        // Convert to associative arrays with date as the key
        $incomeArray = $incomeData->mapWithKeys(function ($item) {
            return [$item['tanggal'] => $item['nominal']];
        })->toArray();

        $outcomeArray = $outcomeData->mapWithKeys(function ($item) {
            return [$item['tanggal'] => $item['nominal']];
        })->toArray();

        // Get all unique dates
        $allDates = array_unique(array_merge(array_keys($incomeArray), array_keys($outcomeArray)));
        sort($allDates);

        // Prepare final data arrays
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
            'outcomeFinal' => $outcomeFinal
        ]);
    }
}
