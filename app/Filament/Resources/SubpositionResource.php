<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubpositionResource\Pages;
use App\Filament\Resources\SubpositionResource\RelationManagers;
use App\Models\Subposition;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubpositionResource extends Resource
{
    protected static ?string $model = Subposition::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $modelLabel = 'товарная подпозиция';

    protected static ?string $pluralModelLabel = 'товарные подпозиции';

    protected static ?string $navigationGroup = 'ТН ВЭД';

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('group_position')->sortable()->label('Код группы'),
                TextColumn::make('position.name')->label('Наименование группы')
                    ->words(2)
                    ->tooltip(fn (Model $record): string => "{$record->position->name}")

                    ->searchable(),
                TextColumn::make('code')->sortable()->label('Код подпозиции'),
                TextColumn::make('name')->label('Наименование')
                    ->words(5)
                    ->searchable(),
                TextColumn::make('started_at')
                    ->date()->sortable()->label('Дата начала действия'),
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
            'index' => Pages\ListSubpositions::route('/'),
            'edit' => Pages\EditSubposition::route('/{record}/edit'),
        ];
    }
}
