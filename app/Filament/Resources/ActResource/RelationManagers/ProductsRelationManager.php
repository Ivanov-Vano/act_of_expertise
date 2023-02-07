<?php

namespace App\Filament\Resources\ActResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'products';


    protected static ?string $recordTitleAttribute = 'Наименование';

    protected static ?string $modelLabel = 'товар';

    protected static ?string $pluralModelLabel = 'товары';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->label('Наименование')
                    ->maxLength(255),
                TextInput::make('brand')
                    ->required()
                    ->label('Марка')
                    ->maxLength(255),
                TextInput::make('item_number')
                    ->required()
                    ->label('Артикул')
                    ->maxLength(255),
                Select::make('hs_code_id')
                    ->relationship('hscode', 'code')
                    ->required()
                    ->label('Код ТН ВЭД'),
                Select::make('code_group_id')
                    ->relationship('code_group', 'number')
                    ->required()
                    ->label('Группа ТН ВЭД'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Наименование'),
                TextColumn::make('brand')
                    ->label('Марка'),
                TextColumn::make('item_number')
                    ->label('Артикул'),
                TextColumn::make('hscode.code')
                    ->label('Код ТН ВЭД'),
                TextColumn::make('code_group.number')
                    ->label('Группа ТН ВЭД'),

            ])
            ->filters([
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
            ]);
    }

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
