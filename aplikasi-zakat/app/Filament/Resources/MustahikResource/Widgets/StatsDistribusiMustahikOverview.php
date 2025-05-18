<?php

namespace App\Filament\Resources\MustahikResource\Widgets;

use App\Filament\Resources\MustahikResource\Pages\ListMustahiks;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsDistribusiMustahikOverview extends BaseWidget
{
    use InteractsWithPageTable;
    
    protected ?string $heading = 'Analytics';

    protected ?string $description = 'An overview of some analytics.';
    protected function getStats(): array
    {
        return [
            Stat::make('Beras', $this->getPageTableQuery()->sum('jumlah_terima_beras') . ' Kg')
                ->description('Beras Terdistribusikan')
                // ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('info'),
            Stat::make('Uang', 'IDR '.number_format($this->getPageTableQuery()->sum('jumlah_terima_uang'),0))
                ->description('Uang Terdistribusikan')
                // ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('warning'),
        ];
    }

    protected function getTablePage(): string
    {
        return ListMustahiks::class;
    }

    protected function getColumns(): int
    {
        return 2;
    }
}
