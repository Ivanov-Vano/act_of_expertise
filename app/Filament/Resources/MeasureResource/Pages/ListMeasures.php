<?php

namespace App\Filament\Resources\MeasureResource\Pages;

use App\Filament\Resources\MeasureResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMeasures extends ListRecords
{
    protected static string $resource = MeasureResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
