<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyResource\Pages;
use App\Filament\Resources\CompanyResource\RelationManagers;
use App\Models\Company;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $modelLabel = 'компания';

    protected static ?string $pluralModelLabel = 'иностранные компании';

    protected static ?string $navigationGroup = 'Справочники';

    protected static ?int $navigationSort = 2;

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('country_id')
                    ->relationship('country', 'short_name')
                    ->required()
                    ->label('Страна'),
                TextInput::make('short_name')
                    ->maxLength(100)
                    ->required()
                    ->label('Наименование'),
                TextInput::make('name')
                    ->maxLength(255)
                    ->label('Полное наименование'),
                TextInput::make('registration_number')
                    ->maxLength(50)
                    ->label('Регистрационный номер'),
                TextInput::make('address')
                    ->maxLength(255)
                    ->label('Адрес'),
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
                TextColumn::make('registration_number')
                    ->searchable()
                    ->label('Регистрационный номер'),
                TextColumn::make('name')
                    ->label('Полное наименование'),
                TextColumn::make('address')
                    ->label('Адрес'),
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
            'index' => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompany::route('/create'),
            'edit' => Pages\EditCompany::route('/{record}/edit'),
        ];
    }
}
