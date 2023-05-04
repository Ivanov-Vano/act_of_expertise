<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Создан новый пользователь';
    }
/*    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['name'] = $data['username'];

        return $data;
    }*/
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

}
