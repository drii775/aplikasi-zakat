<?php

namespace App\Filament\Resources\LaporanMustahikResource\Pages;

use App\Filament\Resources\LaporanMustahikResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLaporanMustahik extends EditRecord
{
    protected static string $resource = LaporanMustahikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
