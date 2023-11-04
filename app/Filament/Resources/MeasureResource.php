<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MeasureResource\Pages;
use App\Filament\Resources\MeasureResource\RelationManagers;
use App\Models\Measure;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MeasureResource extends Resource
{
    protected static ?string $model = Measure::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static ?string $modelLabel = 'единица измерения';

    protected static ?string $pluralModelLabel = 'единицы измерения';

    protected static ?string $navigationGroup = 'Справочники';

    protected static ?int $navigationSort = 6;

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
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMeasures::route('/'),
            'create' => Pages\CreateMeasure::route('/create'),
            'edit' => Pages\EditMeasure::route('/{record}/edit'),
        ];
    }
}
