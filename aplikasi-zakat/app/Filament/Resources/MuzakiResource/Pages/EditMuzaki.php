<?php

namespace App\Filament\Resources\MuzakiResource\Pages;

use App\Filament\Resources\MuzakiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMuzaki extends EditRecord
{
    protected static string $resource = MuzakiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
                ->slideOver(),
            Actions\DeleteAction::make()
                ->slideOver(),
        ];
    }
}
