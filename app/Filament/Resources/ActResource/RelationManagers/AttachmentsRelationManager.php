<?php

namespace App\Filament\Resources\ActResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Closure;

class AttachmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'attachments';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $modelLabel = 'приложение';

    protected static ?string $pluralModelLabel = 'приложения';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Наименование')
                    ->maxLength(255)
                    ->placeholder('При создании приложения, имя генерируется автоматически при нажатии кнопки "Создать"'),
                FileUpload::make('file_path')
                    ->directory('attachments')
                    ->preserveFilenames()
                    ->enableDownload()
                    ->label('Документ')
                    ->storeFileNamesIn('name'),
//                    ->afterStateUpdated(fn ($state, callable $set) => $set('name', $state)), //TODO вместо "Имя файла" необходимо подставить значение имени выбранного файла без расширения
/*                    ->afterStateUpdated(function (Closure $set, $state) {
                      $set('name',  $state);
                    })*/
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Наименование'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
