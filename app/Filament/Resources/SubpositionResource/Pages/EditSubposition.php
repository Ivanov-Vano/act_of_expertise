<?php

namespace App\Filament\Resources\SubpositionResource\Pages;

use App\Filament\Resources\SubpositionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSubposition extends EditRecord
{
    protected static string $resource = SubpositionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
