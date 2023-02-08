<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TypeActResource\Pages;
use App\Filament\Resources\TypeActResource\RelationManagers;
use App\Models\TypeAct;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TypeActResource extends Resource
{
    protected static ?string $model = TypeAct::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $modelLabel = 'тип';

    protected static ?string $pluralModelLabel = 'типы';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('short_name')
                    ->maxLength(50)
                    ->required()
                    ->label('Наименование'),
                TextInput::make('name')
                    ->maxLength(255)
                    ->label('Полное наименование'),
                MarkdownEditor::make('description')
                    ->label('Описание')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('short_name')
                    ->label('Краткое наименование'),
                TextColumn::make('name')
                    ->label('Наименование'),
                TextColumn::make('description')
                    ->label('Описание'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTypeActs::route('/'),
        ];
    }
}
