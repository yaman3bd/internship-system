<?php

namespace App\Filament\Resources\UserResource\RelationManagers;


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
            ->schema([]);
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
                BadgeColumn::make('status')
                           ->label('Application Status')
                           ->getStateUsing(function ($record) {
                               return \Illuminate\Support\Str::of($record->status)->replace('_', ' ')->headline();
                           })
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
                EditAction::make()
                          ->url(fn($record) => route('filament.resources.applications.edit', $record->id)),
                ViewAction::make()
                          ->url(fn($record) => route('filament.resources.applications.view', $record->id)),
            ]);
    }
}
