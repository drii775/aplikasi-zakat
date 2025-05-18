<?php

namespace App\Filament\Resources\LaporanPengumupulanZakatResource\Pages;

use App\Filament\Resources\LaporanPengumupulanZakatResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ListLaporanPengumupulanZakats extends ListRecords
{
    protected static string $resource = LaporanPengumupulanZakatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
            ExportAction::make()
                ->exports([
                    ExcelExport::make('Export Excel')->fromTable(),
                ]),
        ];
    }
}
