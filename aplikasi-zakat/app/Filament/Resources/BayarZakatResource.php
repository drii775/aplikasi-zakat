<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BayarZakatResource\Pages;
use App\Filament\Resources\BayarZakatResource\RelationManagers;
use App\Models\BayarZakat;
use Dom\Text;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BayarZakatResource extends Resource
{
    protected static ?string $model = BayarZakat::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationLabel = 'Bayar Zakat';

    protected static ?string $pluralLabel = 'Bayar Zakat';

    protected static ?int $navigationSort = 31;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('tahun')
                    ->options([
                        date('Y') => date('Y'),
                    ]),
                Select::make('zakat_muzaki_id')
                    ->relationship('zakat_muzaki', 'nama_lengkap')
                    ->getOptionLabelFromRecordUsing(fn (Model $record) => $record->nik . ' - ' . $record->nama_lengkap)
                    ->required()
                    ->searchable()
                    ->preload(),
                Select::make('jenis_bayar')
                    ->options([
                        'Beras' => 'Beras',
                        'Uang' => 'Uang',
                    ])
                    ->multiple()
                    ->required()
                    ->live()
                    ->reactive(),
                Forms\Components\TextInput::make('jumlah_tanggungan_dibayar')
                    ->numeric(),
                Forms\Components\TextInput::make('bayar_beras')
                    ->default(0)
                    ->postfix('KG'),
                Forms\Components\TextInput::make('bayar_uang')
                    ->default(0)
                    ->prefix('IDR')
                    ->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(','),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function(Builder $query) {
                return $query->join('zakat_muzaki', 'zakat_bayarzakat.zakat_muzaki_id', '=', 'zakat_muzaki.id');
            })
            ->defaultSort('created_at', 'desc')
            ->columns([
                // Tables\Columns\TextColumn::make('zakat_muzaki_id')
                //     ->numeric()
                //     ->sortable(),
                TextColumn::make('no_kk')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('nik')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('nama_lengkap')
                    ->description(fn(Model $record): string => $record->no_kk . ' - ' . $record->nik, position:'above')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jenis_bayar')
                    ->searchable()
                    ->listWithLineBreaks()
                    ->bulleted(),
                TextColumn::make('tahun'),
                TextColumn::make('jumlah_jiwa')
                    ->summarize(Sum::make())
                    ->badge()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('jumlah_tanggungan_dibayar')
                    ->label('Bayar Zakat')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color('danger')
                    ->summarize(Sum::make())
                    ->alignCenter(),
                ColumnGroup::make('Bayar',[
                    Tables\Columns\TextColumn::make('bayar_beras')
                        ->label('Beras (Kg)')
                        ->numeric()
                        ->alignCenter()
                        ->summarize(Sum::make()),
                    Tables\Columns\TextColumn::make('bayar_uang')
                        ->label('Uang')
                        ->numeric()
                        ->money('IDR')
                        ->summarize(Sum::make()->money('IDR'))
                        ->alignEnd(),
                ])->alignCenter(),
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
                SelectFilter::make('jenis_bayar')
                    ->options([
                        'Beras' => 'Beras',
                        'Uang' => 'Uang',
                    ])
                    ->multiple()
                    ->placeholder('Dapat Dipilih Lebih dari Satu')
                    ->query(function ($query, array $data) {
                        if (filled($data['values'])) {
                            $query->where('jenis_bayar', 'like', '%' . implode('%', $data['values']) . '%');
                        }
                    }),
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
            'index' => Pages\ListBayarZakats::route('/'),
            // 'create' => Pages\CreateBayarZakat::route('/create'),
            // 'view' => Pages\ViewBayarZakat::route('/{record}'),
            // 'edit' => Pages\EditBayarZakat::route('/{record}/edit'),
        ];
    }
}
