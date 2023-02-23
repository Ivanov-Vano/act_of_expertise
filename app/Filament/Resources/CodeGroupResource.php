<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CodeGroupResource\Pages;
use App\Filament\Resources\CodeGroupResource\RelationManagers;
use App\Models\CodeGroup;
use Filament\Forms;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CodeGroupResource extends Resource
{
    protected static ?string $model = CodeGroup::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $modelLabel = 'правило';

    protected static ?string $pluralModelLabel = 'правила';

    protected static ?string $navigationGroup = 'Справочники';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('number')
                    ->required()
                    ->label('Код ТН ВЭД'),
                TextInput::make('name')
                    ->label('Наименование'),
                MarkdownEditor::make('condition')
                    ->label('Условия')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('number')
                    ->label('Код ТН ВЭД'),
                TextColumn::make('name')
                    ->label('Наименование'),
                TextColumn::make('condition')
                    ->label('Условия'),
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
            'index' => Pages\ManageCodeGroups::route('/'),
        ];
    }
}
