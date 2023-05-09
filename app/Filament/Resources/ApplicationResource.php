<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApplicationResource\Pages;
use App\Filament\Resources\ApplicationResource\RelationManagers;
use App\Models\Application;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class ApplicationResource extends Resource
{
    protected static ?string $model = Application::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Academic';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                     ->schema([
                         Section::make('form_info')
                                ->heading('Application Information')
                                ->schema([
                                    Select::make('status')
                                          ->options([
                                              'approved' => 'Approved',
                                              'rejected' => 'Rejected',
                                              'pending' => 'Pending',
                                          ])
                                          ->required(),
                                    SpatieMediaLibraryFileUpload::make('files')
                                                                ->label('Files')
                                                                ->disabled()
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
                TextColumn::make('application_name')
                          ->label('Application Name')
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
                           ->colors([
                               'success' => 'approved',
                               'danger' => 'rejected',
                               'warning' => 'pending'
                           ]),
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
        ];
    }

    protected static function getNavigationBadge(): ?string
    {
        if (auth()->user()->hasRole('career-center')) {
            return parent::getEloquentQuery()->where('status', 'approved')->count();
        } else {
            return static::getModel()::count();
        }

    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        if (auth()->user()->hasRole('career-center')) {
            return parent::getEloquentQuery()->where('status', 'approved');
        } else {
            return parent::getEloquentQuery();
        }

    }
}
