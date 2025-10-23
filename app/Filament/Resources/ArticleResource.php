<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-radio';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               Section::make('Article Details')
                ->description('Provide all essential details about this article.')
                ->schema([
                    Grid::make(2)
                        ->schema([
                            Forms\Components\TextInput::make('title')
                                ->label(' Title')
                                ->placeholder('Enter the book title...')
                                ->prefixIcon('heroicon-o-book-open')
                                ->maxLength(150)
                                ->required()
                                ->hint('Keep it short and descriptive.'),

                            Forms\Components\DatePicker::make('day')
                                ->label('Published Date')
                                ->displayFormat('d M Y')
                                ->prefixIcon('heroicon-o-calendar')
                                ->required(),
                        ]),

                    Forms\Components\RichEditor::make('content')
                        ->label('Content')
                        ->toolbarButtons([
                            'bold',
                            'italic',
                            'underline',
                            'strike',
                            'blockquote',
                            'h2',
                            'h3',
                            'orderedList',
                            'bulletList',
                            'codeBlock',
                            'link',
                            'undo',
                            'redo',
                        ])
                        ->placeholder('Write something engaging about the article')
                        ->disableToolbarButtons(['attachFiles'])
                        ->required()
                        ->columnSpanFull()
                        ->formatStateUsing(fn ($state) => strip_tags($state))
                        ->hint('A short summary helps readers understand the content quickly.'),
                ])
                ->columns(2)
                ->collapsible(),

            Section::make('Image')
                ->description('Upload the cover image for this book.')
                ->schema([
                    Forms\Components\FileUpload::make('image')
                        ->label('Cover Image')
                        ->image()
                        ->imageEditor()
                        ->panelLayout('integrated') // ✅ sleek inline card style
                        ->openable()
                        ->downloadable()
                        ->required()
                        ->hint('Upload a clear and attractive cover image. Recommended size: 600x900px.'),
                ])
                ->collapsible()
                ->columns(1),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                 Tables\Columns\ImageColumn::make('image')
                ->label('Cover')
                ->size(70)
                ->square()
                ->disk('public')
                ->extraAttributes(['class' => 'rounded-lg shadow-sm'])
                ->sortable(),
            Tables\Columns\TextColumn::make('title')
                ->label('Title')
                ->searchable()
                ->sortable()
                ->weight('medium')
                ->icon('heroicon-o-book-open'),
            Tables\Columns\TextColumn::make('content')
                ->label('Description')
                ->limit(50)
                ->wrap()
                ->tooltip(fn ($record) => strip_tags($record->content)),
            Tables\Columns\TextColumn::make('day')
                ->label('Published Date')
                ->date('d M Y')
                ->sortable(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListArticles::route('/'),
            // 'create' => Pages\CreateArticle::route('/create'),
            // 'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
