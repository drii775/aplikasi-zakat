<?php

namespace App\Filament\Resources\BayarZakatResource\Pages;

use App\Filament\Resources\BayarZakatResource;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Pages\ListRecords;

class ListBayarZakats extends ListRecords
{
    protected static string $resource = BayarZakatResource::class;

    use ExposesTableToWidgets;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Bayar Zakat')
                ->icon('heroicon-o-currency-dollar')
                ->slideOver(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            BayarZakatResource\Widgets\StatsBayarZakatOverview::class,
        ];
    }
}
