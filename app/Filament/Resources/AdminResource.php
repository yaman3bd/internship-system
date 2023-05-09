<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdminResource\Pages;
use App\Filament\Resources\AdminResource\RelationManagers;
use App\Models\Admin;
use Awcodes\FilamentBadgeableColumn\Components\BadgeableTagsColumn;
use Closure;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Str;
use Livewire\Component;

class AdminResource extends Resource
{
    protected static ?string $model = Admin::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Staff';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                     ->schema([
                         Section::make('form_info')
                                ->heading('Admin Information')
                                ->schema([
                                    Fieldset::make('info')
                                            ->label('General Information')
                                            ->schema([
                                                TextInput::make('name')
                                                         ->reactive()
                                                         ->afterStateUpdated(function (Closure $set, $state) {
                                                             /*$value = $state . '@admin.st.uskudar.edu.tr';*/
                                                             $value = $state . '@admin.com';
                                                             $set('email', Str::lower(Str::replace(' ', '.', $value)));
                                                         })
                                                         ->required(),
                                                TextInput::make('email')
                                                         ->email()
                                                         ->disabled()
                                                         ->unique(ignoreRecord: true)
                                                         ->required(),
                                                TextInput::make('password')
                                                         ->password()
                                                         ->required()
                                                         ->hidden(fn(Component $livewire
                                                         ): bool => $livewire instanceof Pages\EditAdmin)
                                                         ->columnSpanFull(),
                                            ]),
                                    Fieldset::make('roles')
                                            ->label('Roles And Permissions')
                                            ->schema([
                                                Select::make('roles')
                                                      ->multiple()
                                                      ->relationship('roles', 'nickname')
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
                TextColumn::make('email')->searchable(),
                BadgeableTagsColumn::make('roles.nickname')
                                   ->colors([
                                       'gray',
                                       'success' => 'Super Admin',
                                       'primary' => 'Internship Coordinator',
                                   ])->wrapEvery(2)
                                   ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                                           ->successNotification(
                                               Notification::make()
                                                           ->success()
                                                           ->title('Admin deleted')
                                                           ->body('The user has been deleted successfully.')
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
            'index' => Pages\ListAdmins::route('/'),
            'create' => Pages\CreateAdmin::route('/create'),
            'edit' => Pages\EditAdmin::route('/{record}/edit'),
        ];
    }

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
