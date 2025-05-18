<?php

namespace App\Filament\Widgets;

use App\Models\Mustahik;
use App\Models\MustahikKategori;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class MustahikChart extends ApexChartWidget
{
    use InteractsWithPageFilters;

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 3;
    

    /**
     * Chart Id
     *
     * @var string
     */
    protected static ?string $chartId = 'mustahikChart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Mustahik Zakat';

    protected static ?string $subheading = 'Penerima Zakat';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        $tahun =  $this->filters['tahun'];
        $kategori = MustahikKategori::get();
        $mustahik = Mustahik::where('tahun', $tahun)->get();

        $list_kategori = $kategori->pluck('nama_kategori');

        // Hitung jumlah mustahik untuk setiap kategori
        $jumlah_per_kategori = $kategori->map(function ($item) use ($mustahik) {
            return $mustahik->where('zakat_mustahik_kategori_id', $item->id)->count();
        });

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'Jumlah Mustahik',
                    'data' =>  $jumlah_per_kategori,
                ],
            ],
            'xaxis' => [
                'categories' => $list_kategori,
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'colors' => ['#f59e0b'],
            'plotOptions' => [
                'bar' => [
                    'borderRadius' => 3,
                    'horizontal' => false,
                ],
            ],
        ];
    }

    
}
