<?php

namespace App\Filament\Resources\ActResource\Pages;

use App\Filament\Resources\ActResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Pages\Actions\Action;

class ViewAct extends ViewRecord
{
    protected static string $resource = ActResource::class;

    protected function getActions(): array
    {
        return [
            Action::make('Печать')->button()
            ->url(fn () => route('word.export', $this->record->id ))
            ->openUrlInNewTab(),
            Actions\EditAction::make(),
        ];
    }
}
