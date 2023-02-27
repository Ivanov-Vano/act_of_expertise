<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActResource\Pages;
use App\Filament\Resources\ActResource\RelationManagers;
use App\Models\Act;
use App\Models\Expert;
use App\Models\Organization;
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
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Section;

class ActResource extends Resource
{
    protected static ?string $model = Act::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

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
                    ->relationship('expert', 'full_name')
                    //->relationship('expert', 'surname')
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
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Заказчик экспертизы'),
                Section::make('Количество')
                    ->description('(в единицах измерения)')
                    ->schema([
                        TextInput::make('gross')
                            ->required()
                            ->numeric()
                            ->mask(fn (TextInput\Mask $mask) => $mask
                                ->numeric()
                                ->decimalPlaces(2)
                            )
                            ->label('Брутто'),
                        TextInput::make('netto')
                            ->required()
                            ->numeric()
                            ->mask(fn (TextInput\Mask $mask) => $mask
                                ->numeric()
                                ->decimalPlaces(2)
                            )
                            ->label('Нетто'),
                        TextInput::make('measure')
                            ->datalist(['кг', 'куб. м'])
                            ->required()
                            ->label('Единица измерения'),
                        TextInput::make('position')
                            ->label('Позиции'),
                    ])
                ->columns(3),
                Section::make('Контракт и счет')
                    ->schema([
                        TextInput::make('contract')
                            ->label('Контракт'),
                        TextInput::make('invoice')
                            ->label('Счет'),
                    ])
                    ->columns(2),
                Section::make('Компании')
                    ->description('Грузовое отправление')
                    ->schema([
                        Select::make('exporter_id')
                            ->relationship('exporter', 'short_name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->label('Экспортер'),
                        Select::make('shipper_id')
                            ->searchable()
                            ->preload()
                            ->relationship('shipper', 'short_name')
/*                            ->getSearchResultsUsing(fn (string $search) => Organization::where('short_name', 'like', "%{$search}%")->limit(50)->pluck('short_name', 'id'))
                            ->getOptionLabelUsing(fn ($value): ?string => Organization::find($value)?->short_name)*/
                            ->required()
                            ->label('Грузоотправитель'),
                        Select::make('importer_id')
                            ->relationship('importer', 'short_name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->label('Импортер'),
                        Select::make('consignee_id')
                            ->relationship('consignee', 'short_name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->label('Грузополучатель'),
                        TextInput::make('cargo')
                            ->columnSpanFull()
                            ->label('Транспортное средство'),
                        TextInput::make('package')
                            ->columnSpanFull()
                            ->label('Вид упаковки'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('expert.full_name')->label('Эксперт'),
                TextColumn::make('number')->sortable()->label('Номер')
                ->searchable(),
                TextColumn::make('customer.short_name')->sortable()->label('Заказчик')
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
            RelationManagers\AttachmentsRelationManager::class,
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
