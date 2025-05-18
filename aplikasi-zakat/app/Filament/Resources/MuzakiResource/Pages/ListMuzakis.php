<?php

namespace App\Filament\Resources\MuzakiResource\Pages;

use App\Filament\Resources\MuzakiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMuzakis extends ListRecords
{
    protected static string $resource = MuzakiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Muzaki')
                ->icon('heroicon-s-plus')
                ->slideOver(),
        ];
    }
}
