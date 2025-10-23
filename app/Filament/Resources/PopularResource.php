<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PopularResource\Pages;
use App\Filament\Resources\PopularResource\RelationManagers;
use App\Models\Popular;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class PopularResource extends Resource
{
    protected static ?string $model = Popular::class;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
         Forms\Components\Section::make('Popular Book')
                ->description('Fill in the book information carefully.')
                ->icon('heroicon-o-book-open')
                ->columns(2) // Makes the form layout cleaner
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Book Title')
                        ->placeholder('Enter book title...')
                        ->required()
                        ->maxLength(150)
                        ->prefixIcon('heroicon-o-document-text'),

                    Forms\Components\TextInput::make('type')
                        ->label('Category')
                        ->placeholder('e.g., Novel, Science, Biography...')
                        ->required()
                        ->prefixIcon('heroicon-o-tag'),

                    Forms\Components\TextInput::make('author')
                        ->label('Author Name')
                        ->placeholder('Enter author name...')
                        ->required()
                        ->prefixIcon('heroicon-o-user')
                        ->columnSpan(2),

                    Forms\Components\FileUpload::make('cover')
                        ->label('Book Cover')
                        ->image()
                        ->imageEditor()
                        ->directory('covers')
                        ->required()
                        ->imagePreviewHeight('200')
                        ->openable()
                        ->downloadable()
                        ->preserveFilenames()
                        ->hint('Upload the book cover image (JPG or PNG).'),

                    Forms\Components\FileUpload::make('filebook')
                        ->label('Book File')
                        ->directory('books')
                        ->required()
                        ->downloadable()
                        ->openable()
                        ->acceptedFileTypes(['application/pdf'])
                        ->hint('Upload the full book in PDF format.'),
                        ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                 ImageColumn::make('cover')
                ->label('Cover')
                ->square()
                ->size(70)
                ->disk('public')
                ->extraAttributes(['class' => 'shadow-sm rounded-lg'])
                ->sortable(),

            TextColumn::make('name')
                ->label('Book Title')
                ->searchable()
                ->sortable()
                ->toggleable()
                ->wrap()
                ->icon('heroicon-o-document-text'),

            TextColumn::make('type')
                ->label('Category')
                ->searchable()
                ->sortable()
                ->toggleable()
                ->icon('heroicon-o-tag'),

            TextColumn::make('author')
                ->label('Author')
                ->searchable()
                ->sortable()
                ->toggleable()
                ->icon('heroicon-o-user'),

            Tables\Columns\TextColumn::make('filebook')
                ->label('Book File')
                ->url(fn ($record) => asset('storage/' . $record->filebook))
                ->icon('heroicon-o-document-arrow-down')
                ->openUrlInNewTab()
                ->formatStateUsing(fn ($state) => 'Download'),
            ])
            ->filters([
                //
            ])
            ->actions([
                  Tables\Actions\ActionGroup::make([
                 Tables\Actions\EditAction::make(),
                 Tables\Actions\DeleteAction::make(),
            ])
                ->button()
                ->label('Actions')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListPopulars::route('/'),
            // 'create' => Pages\CreatePopular::route('/create'),
            // 'edit' => Pages\EditPopular::route('/{record}/edit'),
        ];
    }
}
