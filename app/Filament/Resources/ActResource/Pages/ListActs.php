<?php

namespace App\Filament\Resources\ActResource\Pages;

use App\Filament\Resources\ActResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListActs extends ListRecords
{
    protected static string $resource = ActResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
