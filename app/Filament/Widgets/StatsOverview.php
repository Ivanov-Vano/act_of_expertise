<?php

namespace App\Filament\Widgets;

use App\Models\Act;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Всего актов:', Act::query()->count()),
        ];
    }
}
