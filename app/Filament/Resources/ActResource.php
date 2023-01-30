<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActResource\Pages;
use App\Filament\Resources\ActResource\RelationManagers;
use App\Models\Act;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ActResource extends Resource
{
    protected static ?string $model = Act::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $modelLabel = 'акт экспертизы';

    protected static ?string $pluralModelLabel = 'акты';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('expert_id')
                    ->required(),
                Forms\Components\TextInput::make('number')
                    ->required()
                    ->maxLength(255)
                    ->autofocus()
                    ->label('Номер акта'),
                Forms\Components\DatePicker::make('date')
                    ->required()
                    ->label('дата составления акта'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('expert_id'),
                Tables\Columns\TextColumn::make('number')->sortable()->label('Номер'),
                Tables\Columns\TextColumn::make('date')
                    ->date()->sortable()->label('Дата составления'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()->sortable()->label('Создан'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
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
            'index' => Pages\ListActs::route('/'),
            'create' => Pages\CreateAct::route('/create'),
            'view' => Pages\ViewAct::route('/{record}'),
            'edit' => Pages\EditAct::route('/{record}/edit'),
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
