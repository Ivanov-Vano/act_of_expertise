<?php

namespace App\Filament\Resources\SubpositionResource\Pages;

use App\Filament\Resources\SubpositionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubpositions extends ListRecords
{
    protected static string $resource = SubpositionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
