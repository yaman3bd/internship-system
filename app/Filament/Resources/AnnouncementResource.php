<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnnouncementResource\Pages;
use App\Filament\Resources\AnnouncementResource\RelationManagers;
use App\Models\Message;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class AnnouncementResource extends Resource
{
    protected static ?string $model = Message::class;

    protected static ?string $slug = 'announcements';
    protected static ?string $label = 'Announcement';

    protected static ?string $navigationIcon = 'heroicon-o-inbox-in';
    protected static ?string $navigationGroup = 'Academic';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('personal_info')
                        ->label('Announcement Details')
                        ->schema([
                            TextInput::make('data.title')
                                     ->label('Subject')
                                     ->required()
                                     ->columnSpanFull(),
                            Textarea::make('data.body')
                                    ->label('Content')
                                    ->required()
                                    ->columnSpanFull(),
                        ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('data.title')
                          ->label('Subject')
                          ->searchable(),
                TextColumn::make('created_at')
                          ->label('Send Date')
                          ->getStateUsing(function ($record) {
                              return $record->created_at->format('Y-m-d H:i:s');
                          })
                          ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListAnnouncements::route('/'),
            'create' => Pages\CreateAnnouncement::route('/create'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()->where('type', 'announcement')->where('parent_id', null);
    }
}
