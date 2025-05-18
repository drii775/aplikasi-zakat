<?php

namespace App\Filament\Resources\BayarZakatResource\Pages;

use App\Filament\Resources\BayarZakatResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBayarZakat extends ViewRecord
{
    protected static string $resource = BayarZakatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
