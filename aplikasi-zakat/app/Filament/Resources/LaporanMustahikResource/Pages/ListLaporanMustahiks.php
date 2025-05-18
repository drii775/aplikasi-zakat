<?php

namespace App\Filament\Resources\LaporanMustahikResource\Pages;

use App\Filament\Resources\LaporanMustahikResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction as PagesExportAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ListLaporanMustahiks extends ListRecords
{
    protected static string $resource = LaporanMustahikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
            PagesExportAction::make()
                ->exports([
                    ExcelExport::make('Export Excel')->fromTable(),
                ]),
        ];
    }

    public function getTabs(): array
    {
        return [
            'Semua' => Tab::make('Semua')
                        ->icon('heroicon-s-users'),
            'Warga' => Tab::make('Warga')
                        ->modifyQueryUsing(function($query){
                            return $query->where('kategori_penduduk', '0');
                        })
                        ->icon('heroicon-o-user'),
            'Lainnya' => Tab::make('Lainnya')
                        ->modifyQueryUsing(function($query){
                            return $query->where('kategori_penduduk', '1');
                        })
                        ->icon('heroicon-o-users'),
        ];
    }
}
