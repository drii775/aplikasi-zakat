<?php

namespace App\Filament\Resources\BayarZakatResource\Pages;

use App\Filament\Resources\BayarZakatResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBayarZakat extends EditRecord
{
    protected static string $resource = BayarZakatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
