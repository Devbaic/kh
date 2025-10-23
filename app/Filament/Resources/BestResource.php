<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BestResource\Pages;
use App\Filament\Resources\BestResource\RelationManagers;
use App\Models\Best;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BestResource extends Resource
{
    protected static ?string $model = Best::class;

    protected static ?string $navigationIcon = 'heroicon-o-fire';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               Forms\Components\Section::make('Book Information')
            ->schema([
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('by')
                            ->label('By')
                            ->placeholder('Enter author name...')
                            ->prefixIcon('heroicon-o-user')
                            ->required()
                            ->maxLength(100),

                        Forms\Components\TextInput::make('month')
                            ->label('Published Month')
                            ->placeholder('e.g., October 2025')
                            ->prefixIcon('heroicon-o-calendar')
                            ->required()
                            ->maxLength(50),
                    ]),

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
                    ->placeholder('Write something interesting about this book...')
                    ->disableToolbarButtons(['attachFiles'])
                    ->required()
                    ->columnSpanFull(),
            ])
            ->collapsible()
            ->columns(2),

        Forms\Components\Section::make('Uploads')
            ->schema([
                Forms\Components\FileUpload::make('cover')
                    ->label('Cover Image')
                    ->image()
                    ->imageEditor()
                    ->directory('books/covers')
                    ->required()
                    ->hint('Upload a clear and attractive cover image')
                    ->openable()
                    ->downloadable()
                    ->panelLayout('integrated')
                    ->columnSpan(1),

                Forms\Components\FileUpload::make('filebook')
                    ->label('Book File (PDF)')
                    ->acceptedFileTypes(['application/pdf'])
                    ->directory('books/files')
                    ->required()
                    ->hint('Upload the book in PDF format')
                    ->openable()
                    ->downloadable()
                    ->panelLayout('integrated')
                    ->columnSpan(1),
            ])
            ->columns(2)
            ->collapsible(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                  Tables\Columns\ImageColumn::make('cover')
                ->label('Cover')
                ->square()
                ->size(70)
                ->disk('public')
                ->extraAttributes(['class' => 'shadow-sm rounded-lg'])
                ->sortable(),
            Tables\Columns\TextColumn::make('by')
                ->label('By')
                ->sortable()
                ->searchable()
                ->icon('heroicon-o-user'),

            Tables\Columns\TextColumn::make('month')
                ->label('Month')
                ->sortable()
                ->icon('heroicon-o-calendar'),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Uploaded')
                ->dateTime('d M Y')
                ->sortable()
                ->icon('heroicon-o-clock'),

            Tables\Columns\TextColumn::make('filebook')
                ->label('Book File')
                ->formatStateUsing(function ($state) {
                    return $state ? '📘 Available' : '❌ Missing';
                })
                ->color(fn ($state) => $state ? 'success' : 'danger')
                ->tooltip(fn ($state) => $state ? 'Click download below' : 'File not uploaded'),
            ])
            ->filters([

            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                 Tables\Actions\Action::make('download')
                ->label('Download')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('primary')
                ->url(fn ($record) => asset('storage/' . $record->filebook))
                ->openUrlInNewTab(),
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
            'index' => Pages\ListBests::route('/'),
            // 'create' => Pages\CreateBest::route('/create'),
            // 'edit' => Pages\EditBest::route('/{record}/edit'),
        ];
    }
}
