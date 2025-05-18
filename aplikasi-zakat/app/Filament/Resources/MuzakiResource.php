<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MuzakiResource\Pages;
use App\Filament\Resources\MuzakiResource\RelationManagers;
use App\Models\Muzaki;
use App\Models\zakat_muzaki;
use App\Models\ZakatMuzaki;
use Filament\Actions\DeleteAction;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction as ActionsDeleteAction;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MuzakiResource extends Resource
{
    protected static ?string $model = ZakatMuzaki::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Muzaki';

    protected static ?string $pluralLabel = 'Muzaki';

    protected static ?int $navigationSort = 11;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Section::make('Informasi Muzaki')
                    ->schema([
                        TextInput::make('nik')
                            ->label('NIK (Nomor KTP)')
                            ->required(),
                        TextInput::make('no_kk')
                            ->label('Nomor Kartu Keluarga')
                            ->required(),
                        TextInput::make('nama_lengkap')
                            ->required()
                            ->columnSpanFull(),
                        Textarea::make('alamat')
                            ->required()
                            ->columnSpanFull()
                            ->helperText('Alamat lengkap'),
                        TextInput::make('no_hp')
                            ->required(),
                        TextInput::make('email')
                            ->required(),
                        Select::make('jenis_kelamin')
                            ->options([
                                'Laki-Laki' => 'Laki-Laki',
                                'Perempuan' => 'Perempuan',
                            ]),
                        TextInput::make('pekerjaan')
                            ->required(),
                ]),
                Section::make('Informasi Zakat')
                    ->schema([
                        TextInput::make('jumlah_jiwa')
                            ->required()
                            ->helperText('Jumlah anggota keluarga'),
                        DatePicker::make('tanggal_input')
                            ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('no_kk')
                    ->searchable()
                    ->copyable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('nik')
                    ->searchable()
                    ->copyable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('nama_lengkap')
                    ->description(fn(Model $record): string => $record->no_kk . ' '  .$record->nik, position:'above')
                    ->searchable(),
                TextColumn::make('alamat')
                    ->wrap(),
                TextColumn::make('jumlah_jiwa')
                    ->alignCenter()
                    ->summarize(Sum::make()),
                TextColumn::make('no_hp')
                    ->searchable()
                    ->copyable(),
                TextColumn::make('email')
                    ->searchable()
                    ->copyable(),
                TextColumn::make('jenis_kelamin')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Laki-Laki' => 'success',
                        'Perempuan' => 'info',
                    })
                    ->alignCenter(),
                TextColumn::make('pekerjaan'),
                TextColumn::make('tanggal_input')
                    ->date()
                
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->slideOver(),
                    Tables\Actions\EditAction::make()
                        ->color('warning')
                        ->slideOver(),
                    ActionsDeleteAction::make()
                        ->color('danger')
                        ->requiresConfirmation(),
                ])
                ->button()
                ->label('More')
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
            'index' => Pages\ListMuzakis::route('/'),
            // 'create' => Pages\CreateMuzaki::route('/create'),
            // 'view' => Pages\ViewMuzaki::route('/{record}'),
            // 'edit' => Pages\EditMuzaki::route('/{record}/edit'),
        ];
    }
}
