<?php

namespace App\Filament\Resources\MustahikResource\Pages;

use App\Filament\Resources\MustahikResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMustahik extends ViewRecord
{
    protected static string $resource = MustahikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->slideOver(),
        ];
    }
}
