<?php

namespace App\Filament\Resources\TypeActResource\Pages;

use App\Filament\Resources\TypeActResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTypeActs extends ManageRecords
{
    protected static string $resource = TypeActResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
