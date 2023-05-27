<?php

namespace App\Filament\Resources\InternshipApplicationResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class UserRelationManager extends RelationManager
{
    protected static string $relationship = 'user';

    protected static ?string $recordTitleAttribute = 'name';

    protected static function getPluralModelLabel(): string
    {
        return 'Student';
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                          ->label('Student Name')
                          ->searchable(),
                TextColumn::make('email')
                          ->label('Student Email')
                          ->searchable(),
                TextColumn::make('national_id')
                          ->label('Student ID')
                          ->searchable(),
                TextColumn::make('student_no')
                          ->label('Student No')
                          ->searchable(),
                BadgeColumn::make('status')
                           ->colors([
                               'success' => 'active',
                               'danger' => 'inactive',
                           ]),
            ])
            ->filters([
                SelectFilter::make('status')->options([
                    'active' => 'Active',
                    'inactive' => 'Inactive',
                ])
            ])->actions([
                EditAction::make()
                          ->url(fn($record) => route('filament.resources.users.edit', $record->id)),
                ViewAction::make()
                          ->url(fn($record) => route('filament.resources.users.view', $record->id)),
            ]);
    }
}
