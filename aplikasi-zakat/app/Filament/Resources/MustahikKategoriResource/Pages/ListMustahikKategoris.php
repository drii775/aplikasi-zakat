<?php

namespace App\Filament\Resources\MustahikKategoriResource\Pages;

use App\Filament\Resources\MustahikKategoriResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMustahikKategoris extends ListRecords
{
    protected static string $resource = MustahikKategoriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Kategori Mustahik')
                ->icon('heroicon-s-plus')
                ->slideOver(),
        ];
    }
}
