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
//use Filament\Pages\Actions\CreateAction;

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
                    ->placeholder('Выберите приложения и имя сгенерируется автоматически'),
                FileUpload::make('file_path')
                    ->directory('attachments')
                    ->preserveFilenames()
                    ->enableDownload()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set) => $set('name', pathinfo($state->getClientOriginalName(), PATHINFO_FILENAME)))
                    ->label('Документ'),
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
                Tables\Actions\CreateAction::make()
                    //при сохранении записи подставляем имя файла в поле наименование
/*                    ->mutateFormDataUsing(function (array $data): array {
                        $data['name'] = pathinfo($data['file_path'], PATHINFO_FILENAME);
                        return $data;
                    }),*/
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

