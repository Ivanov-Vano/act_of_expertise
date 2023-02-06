<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExpertResource\Pages;
use App\Filament\Resources\ExpertResource\RelationManagers;
use App\Models\Expert;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExpertResource extends Resource
{
    protected static ?string $model = Expert::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $modelLabel = 'эксперт';

    protected static ?string $pluralModelLabel = 'эксперты';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('surname')
                    ->required()
                    ->maxLength(255)
                    ->autofocus()
                    ->label('Фамилия'),
                TextInput::make('name')
                    ->required()
                    ->label('Имя')
                    ->maxLength(255),
                TextInput::make('patronymic')
                    ->label('Отчество')
                    ->maxLength(255),
                FileUpload::make('sign_path')
                    ->label('Подпись'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('surname')->sortable()->label('Фамилия'),
                Tables\Columns\TextColumn::make('name')->label('Имя'),
                Tables\Columns\TextColumn::make('patronymic')->label('Отчество'),
            ])
            ->filters([
/*                Tables\Filters\Filter::make('surname')
                    ->query(fn (Builder $query): Builder => $query->like(%'surname'%)),*/
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListExperts::route('/'),
            'create' => Pages\CreateExpert::route('/create'),
            'view' => Pages\ViewExpert::route('/{record}'),
            'edit' => Pages\EditExpert::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
