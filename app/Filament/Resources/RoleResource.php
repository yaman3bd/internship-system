<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use App\Filament\Resources\RoleResource\RelationManagers;
use App\Models\Role;
use Awcodes\FilamentBadgeableColumn\Components\BadgeableTagsColumn;
use Closure;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Str;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $navigationIcon = 'heroicon-o-finger-print';
    protected static ?string $navigationGroup = 'Security';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                     ->schema([
                         Section::make('form_info')
                                ->heading('General')
                                ->schema([
                                    Fieldset::make('info')
                                            ->label('General Information')
                                            ->schema([
                                                TextInput::make('name')
                                                         ->reactive()
                                                         ->afterStateUpdated(function (Closure $set, $state) {
                                                             $set('nickname',
                                                                 Str::of($state)->headline());
                                                             $set('name', Str::of($state)
                                                                             ->lower()
                                                                             ->replace(' ', '-')
                                                             );
                                                         })
                                                         ->required()
                                                         ->unique(ignoreRecord: true),
                                                TextInput::make('nickname')
                                                         ->disabled(),
                                                Textarea::make('description')
                                                        ->label('Description')
                                                        ->columnSpanFull()
                                                        ->rows(3)
                                                        ->required(),
                                                Select::make('permissions')
                                                      ->multiple()
                                                      ->relationship('permissions', 'nickname')
                                                      ->columnSpanFull()
                                                      ->preload(),

                                            ]),

                                ])
                                ->columns(),
                     ])
                     ->columns([
                         'sm' => 2,
                     ])
                     ->columnSpan([
                         'sm' => 2,
                     ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('nickname')->searchable(),
                BadgeableTagsColumn::make('permissions.nickname')
                                   ->wrapEvery(3),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()->successNotification(
                    Notification::make()
                                ->success()
                                ->title('Role deleted')
                                ->body('The role has been deleted successfully.')
                ),
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
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()->where('name', '!=', 'super-admin');
    }

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
