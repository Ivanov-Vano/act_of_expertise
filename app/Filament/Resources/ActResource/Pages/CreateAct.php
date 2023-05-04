<?php

namespace App\Filament\Resources\ActResource\Pages;

use App\Filament\Resources\ActResource;
use Filament\Resources\Pages\CreateRecord;


class CreateAct extends CreateRecord
{
    protected static string $resource = ActResource::class;

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Создан новая АКТ';
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

}
