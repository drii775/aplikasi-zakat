<?php

namespace App\Filament\Resources\MustahikKategoriResource\Pages;

use App\Filament\Resources\MustahikKategoriResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMustahikKategori extends ViewRecord
{
    protected static string $resource = MustahikKategoriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->slideOver(),
        ];
    }
}
