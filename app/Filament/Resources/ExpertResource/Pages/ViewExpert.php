<?php

namespace App\Filament\Resources\ExpertResource\Pages;

use App\Filament\Resources\ExpertResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewExpert extends ViewRecord
{
    protected static string $resource = ExpertResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
