<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActResource\Pages;
use App\Filament\Resources\ActResource\RelationManagers;
use App\Models\Act;
use App\Models\Expert;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;

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
                TextInput::make('number')
                    ->required()
                    ->maxLength(255)
                    ->autofocus()
                    ->label('Номер акта'),
                Select::make('type_act_id')
                    ->relationship('type', 'short_name')
                    ->required()
                    ->label('Тип Сертификата'),
                Select::make('expert_id')
                    ->relationship('expert', 'surname')
                    ->required()
                    ->label('Эксперт'),
                DatePicker::make('date')
                    ->required()
                    ->label('дата составления акта'),
                TextInput::make('reason')
                    ->required()
                    ->maxLength(255)
                    ->label('Основание для проведения экспертизы'),
                Select::make('customer_id')
                    ->relationship('customer', 'short_name')
                    ->required()
                    ->label('Заказчик экспертизы'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('expert.surname')->label('Эксперт'),
                TextColumn::make('number')->sortable()->label('Номер')
                ->searchable(),
                TextColumn::make('date')
                    ->date()->sortable()->label('Дата составления'),
                TextColumn::make('created_at')
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
            RelationManagers\ProductsRelationManager::class,
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
