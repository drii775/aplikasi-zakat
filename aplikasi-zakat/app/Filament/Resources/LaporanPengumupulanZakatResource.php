<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LaporanPengumupulanZakatResource\Pages;
use App\Filament\Resources\LaporanPengumupulanZakatResource\RelationManagers;
use App\Models\BayarZakat;
use App\Models\LaporanPengumupulanZakat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;

class LaporanPengumupulanZakatResource extends Resource
{
    protected static ?string $model = BayarZakat::class;

    protected static ?string $navigationIcon = 'heroicon-s-shopping-cart';

    protected static ?string $navigationGroup = 'Laporan Distribusi Zakat';

    protected static ?string $pluralLabel = 'Pengumpulan Zakat';

    protected static ?int $navigationSort = 31;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                return $query
                ->select(
                    'id',
                    'tahun',
                    DB::raw('COUNT(*) as total_muzzaki'),
                    DB::raw('SUM(jumlah_tanggungan_dibayar) as total_jiwa'),
                    DB::raw('SUM(bayar_beras) as total_beras'),
                    DB::raw('SUM(bayar_uang) as total_uang')
                )
                ->groupBy('tahun')
                ->orderBy('tahun', 'desc');
            })
            ->columns([
                //
                TextColumn::make('tahun')
                    ->badge()
                    ->color('info')
                    ->sortable(),
                TextColumn::make('total_muzzaki')
                    ->alignCenter(),
                TextColumn::make('total_jiwa')
                    ->alignCenter(),
                TextColumn::make('total_beras')
                    ->summarize(Sum::make())
                    ->alignCenter(),
                TextColumn::make('total_uang')
                    ->money('IDR')
                    ->summarize(Sum::make()->money('IDR'))
                    ->alignCenter(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLaporanPengumupulanZakats::route('/'),
            // 'create' => Pages\CreateLaporanPengumupulanZakat::route('/create'),
            // 'edit' => Pages\EditLaporanPengumupulanZakat::route('/{record}/edit'),
        ];
    }
}
