<?php

namespace App\Filament\Resources\BayarZakatResource\Widgets;

use App\Filament\Resources\BayarZakatResource\Pages\ListBayarZakats;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsBayarZakatOverview extends BaseWidget
{
    use InteractsWithPageTable;
    
    protected ?string $heading = 'Analytics';

    protected ?string $description = 'An overview of some analytics.';
    protected function getStats(): array
    {
        return [
            Stat::make('Total Muzaki', $this->getPageTableQuery()->count())
                ->description('Total Pembayar Zakat : '.$this->getPageTableQuery()->sum('jumlah_tanggungan_dibayar'))
                // ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('gray'),
            Stat::make('Beras', $this->getPageTableQuery()->sum('bayar_beras') . ' Kg')
                ->description('Beras Terkumpul')
                // ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('info'),
            Stat::make('Uang', 'IDR '.number_format($this->getPageTableQuery()->sum('bayar_uang'),0))
                ->description('Uang Terkumpul')
                // ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('warning'),
        ];
    }

    protected function getTablePage(): string
    {
        return ListBayarZakats::class;
    }
}
