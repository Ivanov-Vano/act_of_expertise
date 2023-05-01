<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrganizationResource\Pages;
use App\Filament\Resources\OrganizationResource\RelationManagers;
use App\Models\Organization;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrganizationResource extends Resource
{
    protected static ?string $model = Organization::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $modelLabel = 'организация';

    protected static ?string $pluralModelLabel = 'организации';

    protected static ?string $navigationGroup = 'Справочники';

    protected static ?int $navigationSort = 1;

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('short_name')
                    ->maxLength(100)
                    ->required()
                    ->label('Наименование'),
                TextInput::make('name')
                    ->maxLength(255)
                    ->label('Полное наименование'),
                TextInput::make('inn')
                    ->maxLength(50)
                    ->label('ИНН'),
                TextInput::make('phone')
                    ->tel()
                    ->maxLength(50)
                    ->label('Телефон'),
                TextInput::make('address')
                    ->maxLength(255)
                    ->label('Юридический адрес'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('country.short_name')
                    ->label('Страна')
                    ->searchable(),
                TextColumn::make('short_name')
                    ->label('Наименование')
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Полное наименование'),
                TextColumn::make('inn')
                    ->label('ИНН'),
                TextColumn::make('phone')
                    ->label('Телефон'),
                TextColumn::make('address')
                    ->label('Юридический адрес'),
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
            'index' => Pages\ListOrganizations::route('/'),
            'create' => Pages\CreateOrganization::route('/create'),
            'view' => Pages\ViewOrganization::route('/{record}'),
            'edit' => Pages\EditOrganization::route('/{record}/edit'),
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
