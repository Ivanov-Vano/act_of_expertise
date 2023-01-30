<?php

namespace App\Filament\Resources\ActResource\Pages;

use App\Filament\Resources\ActResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAct extends ViewRecord
{
    protected static string $resource = ActResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
