<?php

namespace App\Filament\Resources\CodeGroupResource\Pages;

use App\Filament\Resources\CodeGroupResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCodeGroups extends ManageRecords
{
    protected static string $resource = CodeGroupResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
