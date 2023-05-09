<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers\ApplicationsRelationManager;
use App\Models\User;
use Closure;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Str;
use Livewire\Component;


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $label = 'Student';
    protected static ?string $navigationGroup = 'Academic';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                     ->schema([
                         Section::make('student_identity')
                                ->heading('Student Information')
                                ->schema([
                                    Fieldset::make('personal_info')
                                            ->label('Personal Information')
                                            ->schema([
                                                TextInput::make('name')
                                                         ->reactive()
                                                         ->afterStateUpdated(function (Closure $set, $state) {
                                                             $value = $state . '@st.uskudar.edu.tr';
                                                             $set('email', Str::lower(Str::replace(' ', '.', $value)));
                                                         })
                                                         ->unique(ignoreRecord: true)
                                                         ->required(),
                                                TextInput::make('email')
                                                         ->email()
                                                         ->disabled()
                                                         ->unique(ignoreRecord: true)
                                                         ->required(),
                                                TextInput::make('phone')
                                                         ->tel()
                                                         ->unique(ignoreRecord: true)
                                                         ->required(),
                                                Select::make('gender')
                                                      ->options([
                                                          'male' => 'Male',
                                                          'female' => 'Female',
                                                          'unknown' => 'Unknown',
                                                      ])
                                                      ->required(),

                                            ]),
                                    Fieldset::make('academic_info')
                                            ->label('Academic Information')
                                            ->schema([
                                                TextInput::make('student_no')
                                                         ->label('Student Number')
                                                         ->numeric()
                                                         ->unique(ignoreRecord: true)
                                                         ->required(),
                                                Select::make('status')
                                                      ->options([
                                                          'active' => 'Active',
                                                          'inactive' => 'Inactive',
                                                      ])
                                                      ->default('active')
                                                      ->required(),
                                            ]),
                                    Fieldset::make('identification_info')
                                            ->label('Identification Information')
                                            ->schema([
                                                TextInput::make('national_id')
                                                         ->unique(ignoreRecord: true)
                                                         ->required(),
                                                Select::make('country_code')
                                                      ->label('Nationality')
                                                      ->options(getCountries()
                                                          ->pluck('name',
                                                              'iso_3166_1_alpha2'))
                                                      ->searchable()
                                                      ->required(),

                                                DatePicker::make('date_of_birth')
                                                          ->format('d.m.Y')
                                                          ->required(),
                                                TextInput::make('place_of_birth')
                                                         ->required(),
                                            ]),
                                    Fieldset::make('address_info')
                                            ->label('Address Information')
                                            ->relationship('address')
                                            ->schema([
                                                Select::make('country_code')
                                                      ->label('Country')
                                                      ->options(getCountries()->pluck('name',
                                                          'iso_3166_1_alpha2'))
                                                      ->searchable()
                                                      ->required(),
                                                TextInput::make('region')
                                                         ->label('Province / State')
                                                         ->required(),
                                                TextInput::make('city')
                                                         ->label('City')
                                                         ->required(),
                                                TextInput::make('postcode')
                                                         ->label('Post code	')
                                                         ->required(),
                                                Textarea::make('address')
                                                        ->label('Address')
                                                        ->columnSpanFull()
                                                        ->required(),

                                            ]),
                                    Fieldset::make('essential_info')
                                            ->label('Security Information')
                                            ->schema([
                                                TextInput::make('password')
                                                         ->password()
                                                         ->required()
                                                         ->hidden(fn(Component $livewire
                                                         ): bool => $livewire instanceof Pages\EditUser)
                                                         ->columnSpanFull(),
                                            ])->hidden(fn(Component $livewire
                                        ): bool => $livewire instanceof Pages\EditUser),
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
                TextColumn::make('id'),
                TextColumn::make('name')->searchable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('national_id')->searchable(),
                TextColumn::make('student_no')->searchable(),
                BadgeColumn::make('status')
                           ->colors([
                               'success' => 'active',
                               'danger' => 'inactive',
                           ]),
                BadgeColumn::make('gender')
            ])
            ->filters([
                SelectFilter::make('gender')->options([
                    'male' => 'Male',
                    'female' => 'Female',
                    'unknown' => 'Unknown',
                ]),
                SelectFilter::make('status')->options([
                    'active' => 'Active',
                    'inactive' => 'Inactive',
                ])
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ApplicationsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
