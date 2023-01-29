<?php

namespace App\Filament\Resources\ExpertResource\Pages;

use App\Filament\Resources\ExpertResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExperts extends ListRecords
{
    protected static string $resource = ExpertResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
