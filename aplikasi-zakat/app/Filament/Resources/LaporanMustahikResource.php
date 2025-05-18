<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LaporanMustahikResource\Pages;
use App\Filament\Resources\LaporanMustahikResource\RelationManagers;
use App\Models\LaporanMustahik;
use App\Models\Mustahik;
use App\Models\MustahikKategori;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;

class LaporanMustahikResource extends Resource
{
    protected static ?string $model = MustahikKategori::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $navigationGroup = 'Laporan Distribusi Zakat';

    protected static ?string $pluralLabel = 'Distribusi Zakat';

    protected static ?int $navigationSort = 32;

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
                // 
                return $query->leftjoin('zakat_mustahik', 'zakat_mustahik_kategori.id', '=', 'zakat_mustahik.zakat_mustahik_kategori_id')
                    ->select(
                        'zakat_mustahik_kategori.id',
                        'zakat_mustahik_kategori.nama_kategori',
                        'zakat_mustahik.tahun',
                        'zakat_mustahik.kategori_penduduk',
                        DB::raw('COUNT(zakat_mustahik.id) as jumlah_mustahik'),
                        DB::raw('SUM(zakat_mustahik.jumlah_terima_beras) as total_beras'),
                        DB::raw('SUM(zakat_mustahik.jumlah_terima_uang) as total_uang'),
                    )
                    ->groupBy('zakat_mustahik_kategori.id', 'zakat_mustahik_kategori.nama_kategori');
            })
            // ->defaultGroup(Group::make('kategori_penduduk')
            //     ->label('Kategori Penduduk'))
            ->columns([
                //
                // TextColumn::make('tahun'),
                TextColumn::make('nama_kategori')
                    ->searchable(),
                TextColumn::make('jumlah_mustahik')
                    ->alignCenter(),
                TextColumn::make('total_beras')
                    ->numeric()
                    ->alignCenter()
                    ->summarize(Sum::make()),
                TextColumn::make('total_uang')
                    ->money('IDR')
                    ->summarize(Sum::make()->money('IDR'))
                    ->alignEnd(),
            ])
            ->filters([
                //
                SelectFilter::make('tahun')
                    ->options(Mustahik::select('tahun')
                        ->distinct()
                        ->orderBy('tahun', 'desc')
                        ->pluck('tahun', 'tahun')
                        ->toArray())
                    ->searchable()
                    ->preload(),
                // SelectFilter::make('kategori_penduduk')
                //     ->options([
                //         '0' => 'warga',
                //         '1' => 'lainnya',
                //     ])
                //     ->searchable()
                //     ->preload()
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
            'index' => Pages\ListLaporanMustahiks::route('/'),
            // 'create' => Pages\CreateLaporanMustahik::route('/create'),
            // 'edit' => Pages\EditLaporanMustahik::route('/{record}/edit'),
        ];
    }
}
