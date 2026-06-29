<?php
namespace App\Filament\Widgets;

use Filament\Widgets\PieChartWidget;
use Filament\Widgets\BarChartWidget;
use Illuminate\Support\Facades\DB;

/*
|-------------------------------------------------------------------------- 
| PIE CHART – Penjualan per Kategori Berdasarkan Order
|-------------------------------------------------------------------------- 
*/
class CategorySalesChart extends PieChartWidget
{
    protected static ?string $heading = 'Penjualan per Kategori';

    protected function getData(): array
    {
        $data = DB::table('order_details')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('categories.category_name', DB::raw('SUM(order_details.quantity) as total'))
            ->groupBy('categories.category_name')
            ->orderByDesc('total')
            ->get();

        // Warna dinamis
        $colors = [
            '#4F46E5', '#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6',
            '#EC4899', '#F97316', '#14B8A6', '#6366F1'
        ];
        $palette = array_slice($colors, 0, $data->count());

        return [
            'labels' => $data->pluck('category_name'),
            'datasets' => [
                [
                    'data' => $data->pluck('total'),
                    'backgroundColor' => $palette,
                    'hoverOffset' => 10,
                ]
            ]
        ];
    }
}

/*
|-------------------------------------------------------------------------- 
| BAR CHART – Produk Terlaris Berdasarkan Order
|-------------------------------------------------------------------------- 
*/
class TopProductChart extends BarChartWidget
{
    protected static ?string $heading = 'Produk Terlaris';

    protected function getData(): array
    {
        $data = DB::table('order_details')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->select('products.product_name', DB::raw('SUM(order_details.quantity) as total'))
            ->groupBy('products.product_name')
            ->orderByDesc('total')
            ->limit(10) // 10 produk terlaris
            ->get();

        // Warna dinamis
        $colors = [
            '#4F46E5', '#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6',
            '#EC4899', '#F97316', '#14B8A6', '#6366F1'
        ];
        $palette = array_slice($colors, 0, $data->count());

        return [
            'labels' => $data->pluck('product_name'),
            'datasets' => [
                [
                    'label' => 'Jumlah Terjual',
                    'data' => $data->pluck('total'),
                    'backgroundColor' => $palette,
                    'borderColor' => '#FFFFFF',
                    'borderWidth' => 1,
                ]
            ]
        ];
    }
}
