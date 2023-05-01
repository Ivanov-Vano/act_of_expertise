<?php

namespace App\Filament\Resources\MeasureResource\Pages;

use App\Filament\Resources\MeasureResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMeasure extends EditRecord
{
    protected static string $resource = MeasureResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
