<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MustahikResource\Pages;
use App\Filament\Resources\MustahikResource\RelationManagers;
use App\Models\Mustahik;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MustahikResource extends Resource
{
    protected static ?string $model = Mustahik::class;

    protected static ?string $navigationIcon = 'heroicon-o-face-smile';

    protected static ?string $navigationGroup = 'Mustahik Zakat';

    protected static ?string $pluralLabel = 'Mustahik';

    protected static ?int $navigationSort = 21;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                ToggleButtons::make('kategori_penduduk')
                    ->inline()
                    ->options([
                        '0' => 'Warga',
                        '1' => 'Lainnya'
                    ])
                    ->icons([
                        '0' => 'heroicon-s-user',
                        '1' => 'heroicon-s-users'
                    ])
                    ->colors([
                        '0' => 'success',
                        '1' => 'info'
                    ])
                    ->default('0')
                    ->columnSpanFull(),
                Select::make('tahun')
                    ->options([
                        date('Y') => date('Y'),
                    ])
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('nama_mustahik')
                    ->label('Nama Mustahik Zakat')
                    ->required()
                    ->columnSpanFull(),
                Select::make('zakat_mustahik_kategori_id')
                    ->relationship('zakat_mustahik_kategori', 'nama_kategori', modifyQueryUsing: fn (Builder $query) => $query->orderBy('id', 'ASC'))
                    ->required(),
                Forms\Components\DateTimePicker::make('tanggal_distribusi')
                    ->required(),
                Forms\Components\TextInput::make('jumlah_terima_beras')
                    ->postfix('KG'), 
                Forms\Components\TextInput::make('jumlah_terima_uang')
                    ->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(',')
                    ->prefix('IDR'),
                Forms\Components\Textarea::make('keterangan')
                    ->rows(5)
                    ->columnSpanFull(),
                
                // Forms\Components\TextInput::make('kategori_penduduk')
                //     ->numeric()
                //     ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function(Builder $query) {
                return $query->join('zakat_mustahik_kategori', 'zakat_mustahik.zakat_mustahik_kategori_id', '=', 'zakat_mustahik_kategori.id')
                    ->select('zakat_mustahik.*', 'zakat_mustahik_kategori.nama_kategori');
            })
            ->defaultGroup(Group::make('nama_kategori')
                ->label('Kategori Mustahik'))
            ->defaultSort('tanggal_distribusi', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('nama_mustahik')
                    ->label('Nama Mustahik Zakat')
                    ->searchable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('nama_kategori')
                    ->numeric()
                    ->sortable()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('kategori_penduduk')
                    ->label('Jenis Penduduk')
                    ->formatStateUsing(fn (string $state): string => $state == '0' ? 'Warga' : 'Lainnya')
                    ->badge()
                    ->color(fn (string $state): string => $state == '0' ? 'success' : 'info')
                    ->alignCenter(),
                ColumnGroup::make('Jumlah Terima', [
                    Tables\Columns\TextColumn::make('jumlah_terima_beras')
                        ->label('Beras')
                        ->numeric()
                        ->summarize(Sum::make())
                        ->alignCenter(),
                    Tables\Columns\TextColumn::make('jumlah_terima_uang')
                        ->label('Uang')
                        ->numeric()
                        ->summarize(Sum::make()->money('IDR'))
                        ->alignEnd(),
                ])->alignCenter(),
                TextColumn::make('keterangan')
                    ->wrap(),
                Tables\Columns\TextColumn::make('tanggal_distribusi')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
                SelectFilter::make('zakat_mustahik_kategori_id')
                    ->label('Kategori Mustahik')
                    ->relationship('mustahik_kategori', 'nama_kategori', modifyQueryUsing: fn (Builder $query) => $query->orderBy('zakat_mustahik_kategori.id', 'ASC'))
                    ->searchable()
                    ->preload(),
                SelectFilter::make('kategori_penduduk')
                    ->options([
                        '0' => 'Warga',
                        '1' => 'Lainnya'
                    ])
                    ->label('Jenis Penduduk'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->slideOver(),
                Tables\Actions\EditAction::make()
                    ->slideOver(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListMustahiks::route('/'),
            // 'create' => Pages\CreateMustahik::route('/create'),
            // 'view' => Pages\ViewMustahik::route('/{record}'),
            // 'edit' => Pages\EditMustahik::route('/{record}/edit'),
        ];
    }
}
