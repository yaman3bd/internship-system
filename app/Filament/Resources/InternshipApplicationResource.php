<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InternshipApplicationResource\Pages;
use App\Filament\Resources\InternshipApplicationResource\RelationManagers;
use App\Models\Application;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Str;

class InternshipApplicationResource extends Resource
{
    protected static ?string $model = Application::class;
    protected static ?string $slug = 'internship-applications';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Applications';
    protected static ?string $label = 'Internship Applications';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                     ->schema([
                         Section::make('form_info')
                                ->heading('Application Information')
                                ->schema([
                                    TextInput::make('type')
                                             ->label('Application Type')
                                             ->dehydrateStateUsing(fn($state) => Str::of($state)->replace(' ',
                                                 '_')->lower())
                                             ->formatStateUsing(fn(string $state
                                             ): string => Str::of($state)->replace('_', ' ')->headline())
                                             ->disabled(),
                                    Select::make('status')
                                          ->options([
                                              'approved' => 'Approved',
                                              'rejected' => 'Rejected',
                                              'pending' => 'Pending',
                                              'waiting_for_sgk' => 'Waiting For SGK'
                                          ])
                                          ->required(),
                                    Textarea::make('message')
                                            ->label('Notes')
                                            ->hint('Leave a note to the student')
                                            ->placeholder('Enter a note to the student')
                                            ->columnSpanFull(),
                                    SpatieMediaLibraryFileUpload::make('files')
                                                                ->label('Files')
                                                                ->collection('files')
                                                                ->multiple()
                                                                ->enableDownload()
                                                                ->columnSpanFull()
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
                TextColumn::make('type')
                          ->label('Application Type')
                          ->getStateUsing(function ($record) {
                              return \Illuminate\Support\Str::of($record->type)->replace('_', ' ')->headline();
                          })
                          ->searchable(),
                TextColumn::make('user.name')
                          ->label('Student Name')
                          ->searchable(),
                TextColumn::make('user.email')
                          ->label('Student Email')
                          ->searchable(),
                TextColumn::make('user.student_no')
                          ->label('Student No')
                          ->searchable(),
                BadgeColumn::make('status')
                           ->label('Application Status')
                           ->getStateUsing(function ($record) {
                               return \Illuminate\Support\Str::of($record->status)->replace('_', ' ')->headline();
                           })
            ])
            ->filters([
                SelectFilter::make('status')->options([
                    'approved' => 'Approved',
                    'rejected' => 'Rejected',
                    'pending' => 'Pending',
                ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([

            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\UserRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListApplications::route('/'),
            'edit' => Pages\EditApplication::route('/{record}/edit'),
            'view' => Pages\ViewApplication::route('/{record}'),
        ];
    }

    protected static function getNavigationBadge(): ?string
    {
        if ( ! auth()->id()) {
            return null;
        }

        if ( ! (auth()->user() instanceof \App\Models\Admin)) {
            return null;
        }

        if (auth()->user()->hasRole('career-center')) {
            return parent::getEloquentQuery()->where('type', 'internship_application')->where('status',
                'waiting_for_sgk')->count();
        } else {
            return static::getModel()::where('type', 'internship_application')->count();
        }
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $baseQuery = parent::getEloquentQuery()->where('type', 'internship_application');
        if (auth()->id() && auth()->user()->hasRole('career-center')) {
            return $baseQuery
                ->where('status', 'waiting_for_sgk');
        } else {
            return $baseQuery;
        }
    }
}
