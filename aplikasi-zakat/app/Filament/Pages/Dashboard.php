<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\MustahikChart;
use App\Filament\Widgets\StatsReportDistribusiZakatOverview;
use App\Filament\Widgets\StatsReportPengumpulanZakatOverview;
use App\Models\BayarZakat;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Pages\Dashboard as PagesDashboard;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Pages\Page;
use Filament\Support\Enums\MaxWidth;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Dashboard extends PagesDashboard
{
    use HasFiltersForm;
    
    protected static ?string $navigationIcon = 'heroicon-o-home';

    // protected static string $view = 'filament.pages.dashboard';

    // protected function getHeaderWidgets(): array {
    //     return [
    //         // WisesaServices::class,
    //         StatsReportPengumpulanZakatOverview::class,
    //         StatsReportDistribusiZakatOverview::class,
    //         MustahikChart::class
    //     ];
    // }

    public function getMaxContentWidth(): MaxWidth
    {
        return MaxWidth::Full;
    }

    public function filtersForm(Form $form): Form
    {
        $tahun = BayarZakat::select('tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun', 'tahun')
            ->toArray();
        return $form
            ->schema([
                //
                Select::make('tahun')
                    ->options($tahun)
                    ->preload()
                    ->default(date('Y'))
                    ->columnSpanFull()
                    ->searchable()
            ]);
    }
}
