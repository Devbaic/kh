<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerResource\Pages;
use App\Filament\Resources\BannerResource\RelationManagers;
use App\Models\Banner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;

    protected static ?string $navigationIcon = 'heroicon-o-bookmark';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                ->label('Book Name')
                ->prefixIcon('heroicon-o-book-open') // better icon for books
                ->placeholder('Enter the book name...')
                ->required()
                ->maxLength(100)
                ->columnSpan(2),
            Forms\Components\RichEditor::make('content')
                ->label('Book Description')
                ->toolbarButtons([
                    'bold',
                    'italic',
                    'underline',
                    'strike',
                    'h2',
                    'h3',
                    'blockquote',
                    'orderedList',
                    'bulletList',
                    'codeBlock',
                    'link',
                    'undo',
                    'redo',
                ])
                ->placeholder('Write something about the book...')
                ->disableToolbarButtons(['attachFiles']) // remove attach files if not needed
                ->required()
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

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\ImageColumn::make('image')
            ->label('Cover')
            ->square()                   // maintains square shape
            ->size(70)                   // adjust as needed
            ->disk('public'),

        Tables\Columns\TextColumn::make('title')
            ->label('Book Name')
            ->sortable()
            ->searchable()
            ->toggleable()
            ->icon('heroicon-o-book-open')
            ->wrap()
            ->extraAttributes([
                'class' => 'font-semibold text-gray-800 text-sm md:text-base' // bold and readable
            ]),

        Tables\Columns\TextColumn::make('content')
            ->label('Description')
            ->limit(50) // shows first 50 characters
            ->formatStateUsing(fn ($state) => strip_tags($state))
            ->tooltip(fn ($record) => $record->content) // full content on hover
            ->wrap()
            ->extraAttributes([
                'class' => 'text-gray-600 text-sm italic' // subtle styling for description
            ]),

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
            'index' => Pages\ListBanners::route('/'),
            // 'create' => Pages\CreateBanner::route('/create'),
            // 'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}
