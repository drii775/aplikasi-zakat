<?php

namespace App\Filament\Resources\MuzakiResource\Pages;

use App\Filament\Resources\MuzakiResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMuzaki extends ViewRecord
{
    protected static string $resource = MuzakiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->slideOver(),
        ];
    }
}
