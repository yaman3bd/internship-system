<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApplicationFileResource\Pages;
use App\Filament\Resources\ApplicationFileResource\RelationManagers;
use App\Models\ApplicationFile;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Livewire\Component;

class ApplicationFileResource extends Resource
{
    protected static ?string $model = ApplicationFile::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';
    protected static ?string $navigationGroup = 'Applications';

    protected static ?string $label = 'Form';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                     ->schema([
                         Section::make('form_info')
                                ->heading('Form Information')
                                ->schema([
                                    TextInput::make('name')
                                             ->required(),
                                    Select::make('status')
                                          ->options([
                                              'public' => 'Public',
                                              'draft' => 'Draft',
                                          ])
                                          ->required(),
                                    SpatieMediaLibraryFileUpload::make('file')
                                                                ->label('Form File')
                                                                ->collection('file')
                                                                ->enableDownload()
                                                                ->maxFiles(1)
                                                                ->required()
                                                                ->hidden(fn(Component $livewire
                                                                ): bool => $livewire instanceof Pages\CreateApplicationFile)
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
                TextColumn::make('name')
                          ->searchable(),
                BadgeColumn::make('status')
                           ->colors([
                               'success' => 'public',
                               'info' => 'draft',
                           ])
            ])
            ->filters([
                SelectFilter::make('status')->options([
                    'public' => 'Public',
                    'draft' => 'Draft',
                ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListApplicationFiles::route('/'),
            'create' => Pages\CreateApplicationFile::route('/create'),
            'edit' => Pages\EditApplicationFile::route('/{record}/edit'),
        ];
    }
}
