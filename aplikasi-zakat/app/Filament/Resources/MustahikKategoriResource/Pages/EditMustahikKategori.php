<?php

namespace App\Filament\Resources\MustahikKategoriResource\Pages;

use App\Filament\Resources\MustahikKategoriResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMustahikKategori extends EditRecord
{
    protected static string $resource = MustahikKategoriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
