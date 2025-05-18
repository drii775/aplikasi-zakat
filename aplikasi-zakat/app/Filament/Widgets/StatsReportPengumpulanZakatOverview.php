<?php

namespace App\Filament\Widgets;

use App\Models\BayarZakat;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsReportPengumpulanZakatOverview extends BaseWidget
{
    use InteractsWithPageFilters;
    
    protected ?string $heading = 'Pengumpulan Zakat';

    protected ?string $description = 'Analisa Pengumpulan Zakat.';

    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        $muzaki         = BayarZakat::where('tahun', $this->filters['tahun'])->count();
        $jumlah_jiwa    = BayarZakat::where('tahun', $this->filters['tahun'])->sum('jumlah_tanggungan_dibayar');
        $beras          = BayarZakat::where('tahun', $this->filters['tahun'])->sum('bayar_beras');
        $uang           = BayarZakat::where('tahun', $this->filters['tahun'])->sum('bayar_uang');

        return [
            Stat::make('Muzaki', $muzaki)
                ->color('success'),
            Stat::make('Jumlah Jiwa', $jumlah_jiwa)
                ->color('success'),
            Stat::make('Pengumpulan Beras', $beras . ' Kg')
                ->color('danger'),
            Stat::make('Pengumpulan Uang', 'IDR ' . number_format($uang, 0))
                ->color('success'),
        ];
    }
}
