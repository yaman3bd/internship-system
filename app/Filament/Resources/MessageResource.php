<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MessageResource\Pages;
use App\Filament\Resources\MessageResource\RelationManagers;
use App\Models\Message;
use App\Models\User;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class MessageResource extends Resource
{
    protected static ?string $model = Message::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox';
    protected static ?string $navigationGroup = 'Academic';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                     ->schema([
                         Section::make('student_identity')
                                ->heading('Send a new message to the student')
                                ->schema([
                                    Fieldset::make('personal_info')
                                            ->label('Message Details')
                                            ->schema([
                                                Select::make('user_id')
                                                      ->label('Student')
                                                      ->options(User::all()->pluck('name', 'id'))
                                                      ->placeholder('Select a student')
                                                      ->required()
                                                      ->helperText('Select a student to send a message to')
                                                      ->searchable()
                                                      ->columnSpanFull(),
                                                TextInput::make('title')
                                                         ->label('Subject')
                                                         ->required()
                                                         ->helperText('Enter a subject for your message')
                                                         ->columnSpanFull(),
                                                Textarea::make('body')
                                                        ->label('Message Body')
                                                        ->hint('Leave a message to the student')
                                                        ->placeholder('Enter your message here')
                                                        ->required()
                                                        ->columnSpanFull(),
                                            ]),
                                ])
                     ])
                     ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('messageable.name')
                          ->label('Sender Name')
                          ->searchable(),
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
                Tables\Actions\EditAction::make()->label('reply'),
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
            'index' => Pages\ListMessages::route('/'),
            'create' => Pages\CreateMessage::route('/create'),
            'edit' => Pages\EditMessage::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $baseQuery = parent::getEloquentQuery()->where('parent_id', null);
        if (auth()->id() && auth()->user()->hasRole('super-admin')) {
            return $baseQuery;
        } else {
            return $baseQuery->where('data->admin_id', auth()->id());
        }
    }
}
