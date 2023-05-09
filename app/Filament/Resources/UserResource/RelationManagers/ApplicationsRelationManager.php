<?php

namespace App\Filament\Resources\UserResource\RelationManagers;


use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class ApplicationsRelationManager extends RelationManager
{
    protected static string $relationship = 'applications';

    protected static ?string $recordTitleAttribute = 'id';

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
                TextColumn::make('application_name'),
                BadgeColumn::make('status')
                           ->label('Application Status')
                           ->colors([
                               'success' => 'approved',
                               'danger' => 'rejected',
                               'warning' => 'pending'
                           ]),
            ])
            ->filters([
                SelectFilter::make('status')
                            ->options([
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                                'pending' => 'Pending',
                            ])
            ])
            ->actions([
                EditAction::make(),
                ViewAction::make()
                          ->url(fn($record) => route('filament.resources.applications.edit', $record->id)),
            ]);
    }
}
