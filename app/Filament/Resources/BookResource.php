<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookResource\Pages;
use App\Filament\Resources\BookResource\RelationManagers;
use App\Models\Book;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';


    public static function form(Form $form): Form
    {
        return
         $form
            ->schema([
             Forms\Components\Section::make('Book Details')
                ->icon('heroicon-o-book-open')
                ->description('Fill out the details below to publish your book.')
                ->collapsible()
                ->schema([

                     Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Name Book')
                            ->prefixIcon('heroicon-o-newspaper')
                            ->placeholder('Enter book name...')
                            ->required()
                            ->maxLength(100)
                            ->columnSpan(2),
                         Forms\Components\TextInput::make('author')
                            ->label('Author Name')
                            ->prefixIcon('heroicon-o-user')
                            ->placeholder('Enter author name...')
                            ->required()
                            ->maxLength(100)
                            ->columnSpan(2),

                         Forms\Components\FileUpload::make('image')
                            ->label('Cover Image')
                            ->image()
                            ->imageEditor()
                            ->directory('books/covers')
                            ->required()
                            ->hint('Upload a cover photo for the book')
                            ->openable()
                            ->downloadable()
                            ->columnSpan(2),
                    ]),

                     Forms\Components\RichEditor::make('description')
                    ->label('Book Description')
                    ->toolbarButtons([
                        'attachFiles',
                        'blockquote',
                        'bold',
                        'bulletList',
                        'codeBlock',
                        'h2',
                        'h3',
                        'italic',
                        'link',
                        'orderedList',
                        'redo',
                        'strike',
                        'underline',
                        'undo',
                    ])
                    ->placeholder('Write something about the book...')
                    ->columnSpanFull()
                    ->disableToolbarButtons(['attachFiles']) // optional: disable unwanted buttons
                    ->required(),
                     Forms\Components\FileUpload::make('filebook')
                        ->label('Book File (PDF)')
                        ->acceptedFileTypes(['application/pdf'])
                        ->directory('books/files')
                        ->required()
                        ->hint('Upload your book file (PDF only)')
                        ->openable()
                        ->downloadable()
                        ->columnSpanFull(),
                ]),
                Forms\Components\ToggleButtons::make('status')
                    ->label('Status')
                    ->boolean() // means: true/false
                    ->grouped()
                    ->colors([
                        'false' => 'danger',
                        'true' => 'success',
                    ])
                    ->icons([
                        'false' => 'heroicon-o-x-circle',
                        'true' => 'heroicon-o-check-circle',
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                ->label('Cover')
                ->square()
                ->size(70)
                ->disk('public')
                ->extraAttributes(['class' => 'shadow-sm']),
                 Tables\Columns\TextColumn::make('name')
                ->label('name ')
                ->icon('heroicon-o-newspaper')
                ->searchable()
                ->sortable()
                ->weight('bold')
                ->color('primary'),

            // 🧑 Author name
            Tables\Columns\TextColumn::make('author')
                ->label('Author')
                ->icon('heroicon-o-user')
                ->searchable()
                ->sortable()
                ->weight('bold')
                ->color('primary'),

            // 📝 Short description (limit characters)
            Tables\Columns\TextColumn::make('description')
                ->label('Description')
                ->limit(60)
                ->toggleable()->wrap()
                ->formatStateUsing(fn ($state) => strip_tags($state)),

            // 📘 File link (downloadable)
            Tables\Columns\TextColumn::make('filebook')
                ->label('Book File')
                ->url(fn ($record) => asset('storage/' . $record->filebook))
                ->icon('heroicon-o-document-arrow-down')
                ->openUrlInNewTab()
                ->formatStateUsing(fn ($state) => 'Download'),
            Tables\Columns\IconColumn::make('status')
                ->label('Liked?')
                ->boolean() // ✅ auto converts 1/0 or true/false
                ->trueIcon('heroicon-o-hand-thumb-up')
                ->falseIcon('heroicon-o-hand-thumb-down')
                ->trueColor('success')
                ->falseColor('danger'),
            // 🕒 Created date
            Tables\Columns\TextColumn::make('created_at')
                ->label('Uploaded')
                ->dateTime('M d, Y')
                ->sortable()
                ->icon('heroicon-o-calendar'),
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
            'index' => Pages\ListBooks::route('/'),
            // 'create' => Pages\CreateBook::route('/create'),
            // 'edit' => Pages\EditBook::route('/{record}/edit'),
        ];
    }
}
