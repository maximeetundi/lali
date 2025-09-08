<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Shop\SkuStockResource\Schema;

use Domain\Shop\Stock\Enums\StockType;
use Domain\Shop\Stock\Models\SkuStock;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Illuminate\Validation\Rule;

final class SkuStockSchema
{
    private function __construct()
    {
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                   ->schema(self::schema())
                    ->columns(2)
                    ->columnSpan([
                        'lg' => fn (?SkuStock $record) => null === $record ? 3 : 2,
                    ]),
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->translateLabel()
                            ->content(fn (SkuStock $record): ?string => $record->created_at?->diffForHumans()),

                        Forms\Components\Placeholder::make('updated_at')
                            ->translateLabel()
                            ->content(fn (SkuStock $record): ?string => $record->updated_at?->diffForHumans()),
                    ])
                    ->columnSpan(['lg' => 1])
                    ->hiddenOn('create'),
            ])
            ->columns(3);
    }

    public static function schema(bool $hasSku = true): array
    {
        return [
            Forms\Components\Select::make('sku_id')
                ->translateLabel()
                ->relationship('sku', 'code')
                ->searchable()
                ->preload()
                ->required()
//                ->unique(
//                    ignoreRecord: true,
//                    modifyRuleUsing: fn (Unique $rule, Forms\Get $get) => $rule
//                        ->where('branch_id', $get('branch_id'))
//                )
                ->rule(fn (Forms\Get $get, ?SkuStock $record) => function ($attribute, $value, $fail) use (
                    $record,
                    $get,
                ) {

                    if (null !== $record) {
                        return;
                    }

                    $exist = SkuStock::query()
                        ->where('sku_id', $value)
                        ->exists();

                    if ($exist) {
                        $fail('The selected sku is already in stock with branch.');
                    }

                })
                ->disabledOn('edit')
                ->visible($hasSku),



            Forms\Components\Radio::make('type')
                ->translateLabel()
                ->optionsFromEnum(StockType::class)
                ->required()
                ->reactive()
                ->columnSpanFull(),

            Forms\Components\TextInput::make('count')
                ->translateLabel()
                ->disabled(fn (Get $get) => StockType::BASE_ON_STOCK->value !== $get('type'))
                ->numeric()
                ->minValue(0)
                ->maxValue(500_000)
                ->rule(
                    fn (Get $get) => Rule::requiredIf(StockType::BASE_ON_STOCK->value === $get('type'))
                )
                ->helperText(trans('Required if type is base on stock.')),

            Forms\Components\TextInput::make('warning')
                ->translateLabel()
                ->disabled(fn (Get $get) => StockType::BASE_ON_STOCK->value !== $get('type'))
                ->numeric()
                ->minValue(0)
                ->maxValue(500_000)
                ->rule(
                    fn (Get $get) => Rule::requiredIf(StockType::BASE_ON_STOCK->value === $get('type'))
                )
                ->helperText(trans('Get warning when reach the specified amount of count.')),
        ];
    }
}
