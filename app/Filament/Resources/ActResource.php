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
use Filament\Tables\Actions\ReplicateAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Section;

class ActResource extends Resource
{
    protected static ?string $model = Act::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static function getNavigationBadge(): ?string
    {
//        return static::getModel()::count();
        $user = auth()->user();
        if ($user->hasAnyRole(['Администратор', 'Суперпользователь'])) {
            return static::getModel()::count();
        }
        return static::getEloquentQuery()
            ->whereBelongsTo(auth()->user()->expert)->count();
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
                TextInput::make('date')
                    ->required()
                    ->type('date')
                    ->label('дата составления акта'),
                TextInput::make('reason')
                    ->maxLength(255)
                    ->label('Основание для проведения экспертизы'),
                Select::make('customer_id')
                    ->relationship('customer', 'short_name')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
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
                    ])
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
                        Select::make('measure_id')
                            ->default('кг')
                            ->relationship('measure', 'short_name')
                            ->required()
                            ->createOptionForm([
                                TextInput::make('short_name')
                                    ->maxLength(50)
                                    ->required()
                                    ->label('Наименование'),
                                TextInput::make('name')
                                    ->maxLength(255)
                                    ->label('Полное наименование'),
                            ])
                            ->label('Единица измерения'),
                        TextInput::make('position')
                            ->label('Количество мест'),
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
                            ->createOptionForm([
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
                            ])
                            ->reactive()
                            ->afterStateUpdated(fn ($state, callable $set) => $set('shipper_id', $state))
                            ->required()
                            ->label('Экспортер'),
                        Select::make('shipper_id')
                            ->searchable()
                            ->preload()
                            ->relationship('shipper', 'short_name')
                            ->required()
                            ->createOptionForm([
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
                            ])
                            ->label('Грузоотправитель'),
                        Select::make('importer_id')
                            ->relationship('importer', 'short_name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
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
                            ])
                            ->reactive()
                            ->afterStateUpdated(fn ($state, callable $set) => $set('consignee_id', $state))
                            ->label('Импортер'),
                        Select::make('consignee_id')
                            ->relationship('consignee', 'short_name')
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
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
                            ])
                            ->required()
                            ->label('Грузополучатель'),
                        Select::make('transport_id')
                            ->relationship('transport', 'name')
                            ->required()
                            ->columnSpanFull()
                            ->label('Транспортное средство')
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->label('Наименование'),
                            ]),
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
                TextColumn::make('expert.full_name')
                    ->sortable()
                    ->searchable()
                    ->toggleable()
                    ->label('Эксперт'),
                TextColumn::make('number')
                    ->sortable()
                    ->label('Номер')
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('customer.short_name')
                    ->sortable()
                    ->label('Заказчик')
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('exporter.short_name')
                    ->sortable()
                    ->label('Экспортер')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                TextColumn::make('importer.short_name')
                    ->sortable()
                    ->label('Импортер')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                TextColumn::make('date')
                    ->date('d.m.Y')
                    ->sortable()
                    ->toggleable()
                    ->label('Дата составления'),
                TextColumn::make('created_at')
                    ->dateTime('d.m.Y H:i:s')
                    ->sortable()
                    ->toggleable()
                    ->label('Создан'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
//                Tables\Actions\ViewAction::make(),
                ReplicateAction::make(),
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
        $user = auth()->user();

        if ($user->hasAnyRole(['Администратор', 'Суперпользователь'])) {
            return parent::getEloquentQuery()
                ->withoutGlobalScopes([
                    SoftDeletingScope::class,
                ]);
        }
        return parent::getEloquentQuery()
            ->whereBelongsTo(auth()->user()->expert)
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
