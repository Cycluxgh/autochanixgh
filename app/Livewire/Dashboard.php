<?php

namespace App\Livewire;

use App\Models\Company;
use App\Models\Customer;
use App\Models\Diagnosis;
use App\Models\Insurance;
use App\Models\Renewal;
use App\Util;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Dashboard extends Component
{
    use Util;

    public $dashboardStats;
    public $insurances = [];
    public function mount()
    {
        $this->dashboardStats = Cache::remember('dashboard.stats', now()->addMinutes(5), function () {
            $startOfMonth = Carbon::now()->startOfMonth();
            $endOfMonth = Carbon::now()->endOfMonth();

            $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
            $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth();

            // Helper closure to reuse the query structure for each model
            $fetchStats = function ($model) use ($startOfMonth, $endOfMonth, $startOfLastMonth, $endOfLastMonth) {
                return $model::selectRaw('
                COUNT(*) as total,
                SUM(CASE WHEN created_at BETWEEN ? AND ? THEN 1 ELSE 0 END) as this_month,
                SUM(CASE WHEN created_at BETWEEN ? AND ? THEN 1 ELSE 0 END) as last_month
            ', [
                    $startOfMonth, $endOfMonth,
                    $startOfLastMonth, $endOfLastMonth,
                ])->first();
            };

            $stats = [
                'customers'  => $fetchStats(Customer::class),
                'companies'  => $fetchStats(Company::class),
                'insurances' => $fetchStats(Insurance::class),
                'renewals'   => $fetchStats(Renewal::class),
                'diagnoses'  => $fetchStats(Diagnosis::class),
            ];

            $results = [];
            foreach ($stats as $key => $data) {
                $total = (int) $data->total;
                $thisMonth = (int) $data->this_month;
                $lastMonth = (int) $data->last_month;
                $diff = $thisMonth - $lastMonth;
                $percent = $lastMonth > 0 ? ($diff / $lastMonth) * 100 : 0;
                $trend = $diff >= 0 ? 'upwards' : 'downwards';

                // Total growth percentage (overall growth)
                $totalPercent = $total > 0 ? ($thisMonth / $total) * 100 : 0;

                $results[$key] = [
                    'total' => $this->formatNumberShort($total),
                    'this_month' => $thisMonth,
                    'last_month' => $lastMonth,
                    'percent' => round($percent, 2),
                    'total_percent' => round($totalPercent, 2),
                    'trend' => $trend,
                ];
            }

            $startOfDay = Carbon::now()->startOfDay();
            $endOfDay = Carbon::now()->endOfDay();

            $totalExpirations = Insurance::whereBetween('expiration', [$startOfDay, $endOfDay])->count();
            $totalInsurances = $results['insurances']['total'];

            return array_merge($results, [
                'expirations' => [
                    'total' => $totalExpirations,
                    'total_percent' => $totalInsurances > 0 ? ($totalExpirations / $totalInsurances) * 100 : 0,
                ],
            ]);
        });

        $this->insurances = Insurance::orderBy('expiration', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
