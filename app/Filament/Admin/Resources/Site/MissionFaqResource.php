<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Site;

use Exception;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Domain\Site\MissionFaq\Enums\Status;
use Illuminate\Database\Eloquent\Builder;
use Domain\Site\MissionFaq\Models\MissionFaq;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Filament\Admin\Resources\Access\ActivityResource\RelationManagers\ActivitiesRelationManager;

class MissionFaqResource extends Resource
{
    protected static ?string $model = MissionFaq::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?int $navigationSort = 5;

    protected static ?string $recordTitleAttribute = 'name';
    public static function getModelLabel(): string
    {
        return __("MissionFaq");
    }

        public static function getPluralModelLabel(): string
    {
        return __("MissionFaqs");
    }

    public static function getNavigationGroup(): ?string
    {
        return trans('Site');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->translateLabel()
                            ->required()
                            ->unique(ignoreRecord: true),

                     Forms\Components\Select::make('status')
                            ->translateLabel()
                            ->optionsFromEnum(Status::class)
                            ->default(Status::MISSION)
                            ->required(),    

                        Forms\Components\RichEditor::make('fr')
                            ->translateLabel()
                            ->nullable()
                            ->string()
                            ->columnSpanFull(),

                        Forms\Components\RichEditor::make('en')
                            ->translateLabel()
                            ->nullable()
                            ->string()
                            ->columnSpanFull(),


                   
                    ])->columnSpan(['lg' => fn (?MissionFaq $record) => null === $record ? 3 : 2]),
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->translateLabel()
                            ->content(fn (MissionFaq $record): ?string => $record->created_at?->diffForHumans()),

                        Forms\Components\Placeholder::make('updated_at')
                            ->translateLabel()
                            ->content(fn (MissionFaq $record): ?string => $record->updated_at?->diffForHumans()),
                    ])
                    ->columnSpan(['lg' => 1])
                    ->hiddenOn('create'),

            ])
            ->columns(3);
    }

    /** @throws Exception */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make(config('eloquent-sortable.order_column_name'))
                    ->label('#')
                    ->translateLabel()
                    ->translateLabel()
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),


                Tables\Columns\TextColumn::make('name')
                    ->translateLabel()
                    ->searchable()
                    ->sortable(),

        

                Tables\Columns\TextColumn::make('updated_at')
                    ->translateLabel()
                    ->sortable()
                    ->dateTime(),

                Tables\Columns\TextColumn::make('created_at')
                    ->translateLabel()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable()
                    ->dateTime(),

                Tables\Columns\TextColumn::make('deleted_at')
                    ->translateLabel()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable()
                    ->dateTime(),
            ])
            ->filters([

                Tables\Filters\SelectFilter::make('status')
                    ->translateLabel()
                    ->optionsFromEnum(Status::class),


                Tables\Filters\TrashedFilter::make()
                    ->translateLabel(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->translateLabel(),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\DeleteAction::make()
                        ->translateLabel(),
                    Tables\Actions\RestoreAction::make()
                        ->translateLabel(),
                    Tables\Actions\ForceDeleteAction::make()
                        ->translateLabel(),
                ]),
            ])
            ->defaultSort(config('eloquent-sortable.order_column_name'))
            ->reorderable(config('eloquent-sortable.order_column_name'))
            ->paginatedWhileReordering();
    }

    public static function getRelations(): array
    {
        return [
            ActivitiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => MissionFaqResource\Pages\ListMissionFaqs::route('/'),
            'create' => MissionFaqResource\Pages\CreateMissionFaq::route('/create'),
            'edit' => MissionFaqResource\Pages\EditMissionFaq::route('/{record}/edit'),
        ];
    }

    /** @return \Illuminate\Database\Eloquent\Builder<\Domain\Site\MissionFaq\Models\MissionFaq> */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
