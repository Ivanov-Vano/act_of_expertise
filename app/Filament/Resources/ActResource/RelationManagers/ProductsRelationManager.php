<?php

namespace App\Filament\Resources\ActResource\RelationManagers;

use App\Models\CodeGroup;
use App\Models\Product;
use App\Models\Subposition;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Radio;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;

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
                    ->columnSpanFull()
                    ->maxLength(255),
                TextInput::make('brand')
                    ->label('Марка')
                    ->maxLength(255),
                TextInput::make('item_number')
                    ->label('Артикул')
                    ->maxLength(255),
                Select::make('subposition_id')
                    ->relationship('tnved_code', 'code')
                    ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->full_code} / {$record->position->name} {$record->name}")
                    ->preload()
                    ->searchable()
                    ->columnSpanFull()
                    ->label('Код ТН ВЭД'),
                Select::make('code_group_id')
                    ->relationship('code_group', 'number')
                    /*                    ->relationship('code_group', 'number', fn (Builder $query) => $query
                                            ->orderBy('id'))*/
                    ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->number} / {$record->name}")
                    ->required()
                    ->label('Правила')
                    ->searchable()
                    ->columnSpanFull()
                    ->preload(),
                Select::make('manufacturer_id')
                    ->relationship('manufacturer', 'short_name')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->columnSpanFull()
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
                    ->label('Изготовитель'),
                Radio::make('origin_criterion')
                    ->options(['Полная' => 'полностью произведен', 'Достаточная' => 'достаточная обработка'])
                    ->inline()
                    ->required()
                    ->label('Критерий происхождения'),
                Section::make('Количество')
                    ->description('(в единицах измерения)')
                    ->schema([
                        TextInput::make('gross')
                            ->numeric()
                            ->mask(fn (TextInput\Mask $mask) => $mask
                                ->numeric()
                                ->decimalPlaces(2)
                            )
                            ->label('Брутто'),
                        TextInput::make('netto')
                            ->numeric()
                            ->mask(fn (TextInput\Mask $mask) => $mask
                                ->numeric()
                                ->decimalPlaces(2)
                            )
                            ->label('Нетто'),
                        Select::make('measure_id')
                            ->default('кг')
                            ->relationship('measure', 'short_name')
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
                        ]),
                        TextInput::make('description')
                            ->columnSpanFull()
                            ->label('Описание'),
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
                TextColumn::make('code_group.number')
                    ->tooltip(fn (Model $record): string => "{$record->code_group->name}")
                    ->label('Группа ТН ВЭД'),
                TextColumn::make('tnved_code.full_code')
                    ->description(fn (Product $record):string => $record->tnved_code->name)
                    ->label('Код ТН ВЭД'),

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
