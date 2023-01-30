<?php

namespace App\Filament\Resources\ActResource\Pages;

use App\Filament\Resources\ActResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAct extends EditRecord
{
    protected static string $resource = ActResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
