<?php
namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Carbon;

class DashboardStats extends BaseWidget
{
    protected function getStats(): array
    {
        // ========================================
        // ALL TIME TOTALS FROM DATABASE
        // ========================================
        $currentUsers    = User::count();
        $currentOrders   = Order::count();
        $currentProducts = Product::count();
        $currentRevenue  = Order::sum('total_amount');

        // ========================================
        // PREVIOUS WEEK TOTALS FOR COMPARISON
        // ========================================
        $lastWeekUsers    = $this->getPreviousWeek(User::class);
        $lastWeekOrders   = $this->getPreviousWeek(Order::class);
        $lastWeekProducts = $this->getPreviousWeek(Product::class);
        $lastWeekRevenue  = $this->getPreviousWeekRevenue();

        // ========================================
        // CHARTS — FULL ALL TIME (HARIAN)
        // ========================================
        $userChartData    = $this->getDaily(User::class);
        $orderChartData   = $this->getDaily(Order::class);
        $productChartData = $this->getDaily(Product::class);
        $revenueChartData = $this->getDailyRevenue();

        return [
            Stat::make('Total Users', $currentUsers)
                ->description($this->formatChange($this->change($currentUsers, $lastWeekUsers)))
                ->descriptionIcon($this->icon($this->change($currentUsers, $lastWeekUsers)))
                ->color('primary')
                ->chart($userChartData),

            Stat::make('Total Orders', $currentOrders)
                ->description($this->formatChange($this->change($currentOrders, $lastWeekOrders)))
                ->descriptionIcon($this->icon($this->change($currentOrders, $lastWeekOrders)))
                ->color('secondary')
                ->chart($orderChartData),

            Stat::make('Total Products', $currentProducts)
                ->description($this->formatChange($this->change($currentProducts, $lastWeekProducts)))
                ->descriptionIcon($this->icon($this->change($currentProducts, $lastWeekProducts)))
                ->color('success')
                ->chart($productChartData),

            Stat::make('Total Revenue', 'Rp' . number_format($currentRevenue, 0, ',', '.'))
                ->description($this->formatChange($this->change($currentRevenue, $lastWeekRevenue)))
                ->descriptionIcon($this->icon($this->change($currentRevenue, $lastWeekRevenue)))
                ->color('danger')
                ->chart($revenueChartData),
        ];
    }

    // ============================================================
    // FULL ALL-TIME DAILY STATS (GRAPH)
    // ============================================================
    private function getDaily($model)
    {
        $first = $model::orderBy('created_at')->first();
        if (!$first) return [];

        $start = Carbon::parse($first->created_at)->startOfDay();
        $end   = Carbon::today()->endOfDay();

        $data = [];

        while ($start <= $end) {
            $count = $model::whereDate('created_at', $start)->count();
            $data[] = (int) $count;
            $start->addDay();
        }

        return $data;
    }

    private function getDailyRevenue()
    {
        $first = Order::orderBy('created_at')->first();
        if (!$first) return [];

        $start = Carbon::parse($first->created_at)->startOfDay();
        $end   = Carbon::today()->endOfDay();

        $data = [];

        while ($start <= $end) {
            $sum = Order::whereDate('created_at', $start)->sum('total_amount');
            $data[] = (int) $sum;
            $start->addDay();
        }

        return $data;
    }

    // ============================================================
    // WEEKLY TOTALS
    // ============================================================
    private function getPreviousWeek($model)
    {
        return $model::whereBetween('created_at', [
            now()->subWeek()->startOfWeek(),
            now()->subWeek()->endOfWeek(),
        ])->count();
    }

    private function getPreviousWeekRevenue()
    {
        return Order::whereBetween('created_at', [
            now()->subWeek()->startOfWeek(),
            now()->subWeek()->endOfWeek(),
        ])->sum('total_amount');
    }

    // ============================================================
    // CHANGE & FORMAT UTILITIES
    // ============================================================
    private function change($current, $previous)
    {
        if ($previous == 0) return $current > 0 ? 100 : 0;

        return (($current - $previous) / $previous) * 100;
    }

    private function icon($change)
    {
        if ($change > 0) return 'heroicon-m-arrow-trending-up';
        if ($change < 0) return 'heroicon-m-arrow-trending-down';
        return 'heroicon-m-minus';
    }

    private function formatChange($change)
    {
        $change = round($change, 1);

        if ($change > 0) return "Increased by {$change}%";
        if ($change < 0) return "Decreased by " . abs($change) . "%";

        return "No change";
    }
}
