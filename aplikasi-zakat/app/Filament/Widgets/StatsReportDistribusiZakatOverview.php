<?php

namespace App\Filament\Widgets;

use App\Models\Mustahik;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsReportDistribusiZakatOverview extends BaseWidget
{
    use InteractsWithPageFilters;
    
    protected ?string $heading = 'Distribusi Zakat';

    protected ?string $description = 'Analisa Distribusi Zakat.';

    protected static ?int $sort = 2;
    protected function getStats(): array
    {
        $warga = Mustahik::where('tahun', $this->filters['tahun'])
                            ->where('kategori_penduduk', '0')->get();
        $lainnya = Mustahik::where('tahun', $this->filters['tahun'])
                            ->where('kategori_penduduk', '1')->get();
        return [
            Stat::make('Penerima Warga', $warga->count())
                ->description('Beras : '. $warga->sum('jumlah_terima_beras'). ' Kg - '. 'Uang : IDR '. number_format($warga->sum('jumlah_terima_uang'),0))
                ->color('success'),
            Stat::make('Penerima Lainnya', $lainnya->count())
                ->description('Beras : ' . $lainnya->sum('jumlah_terima_beras'). ' Kg - '. 'Uang : IDR '.number_format( $lainnya->sum('jumlah_terima_uang'), 0))
                ->color('info'),
            // Stat::make('Bounce rate', '21%')
            //     ->description('7% increase')
            //     ->descriptionIcon('heroicon-m-arrow-trending-down')
            //     ->color('danger'),
            // Stat::make('Average time on page', '3:12')
            //     ->description('3% increase')
            //     ->descriptionIcon('heroicon-m-arrow-trending-up')
            //     ->color('success'),
        ];
    }

    protected function getColumns(): int
    {
        return 2;
    }
}
