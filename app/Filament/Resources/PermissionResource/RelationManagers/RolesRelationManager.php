<?php

namespace App\Filament\Resources\PermissionResource\RelationManagers;


use Awcodes\FilamentBadgeableColumn\Components\BadgeableTagsColumn;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;

class RolesRelationManager extends RelationManager
{
    protected static string $relationship = 'roles';
    protected static ?string $title = 'Associated Roles';
    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nickname')
                                          ->required()
                                          ->maxLength(255),
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
            ])
            ->headerActions([
            ])
            ->actions([
                EditAction::make()
                          ->url(fn($record) => route('filament.resources.roles.edit', $record->id)),
            ])
            ->bulkActions([
            ]);
    }
}
