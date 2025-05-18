<?php

namespace App\Filament\Resources\LaporanPengumupulanZakatResource\Pages;

use App\Filament\Resources\LaporanPengumupulanZakatResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLaporanPengumupulanZakat extends EditRecord
{
    protected static string $resource = LaporanPengumupulanZakatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
