<?php

// app/Filament/Resources/BookResource.php
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
use Illuminate\Support\Arr;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;
    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Dasar')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('book_type')
                            ->options([
                                'fisik' => 'Buku Fisik',
                                'digital' => 'Buku Digital',
                            ])
                            ->required()
                            ->live(),
                        Forms\Components\TextInput::make('author')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('publisher')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('release_year')
                            ->numeric()
                            ->minValue(1900)
                            ->maxValue(now()->year),
                        Forms\Components\TextInput::make('category')
                            ->maxLength(100),
                        Forms\Components\TagsInput::make('tags')
                            ->suggestions([
                                'Bestseller', 'Novel', 'Pendidikan', 'Anak', 'Bisnis',
                                'Teknologi', 'Fiksi', 'Non-Fiksi', 'Sejarah', 'Agama'
                            ]),
                    ]),

                Forms\Components\Section::make('Deskripsi')
                    ->schema([
                        Forms\Components\Textarea::make('short_description')
                            ->rows(3)
                            ->required(),
                        Forms\Components\Textarea::make('synopsis')
                            ->rows(5)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Detail')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('isbn')
                            ->label('ISBN')
                            ->unique(ignoreRecord: true)
                            ->maxLength(20),
                        Forms\Components\TextInput::make('page_count')
                            ->numeric()
                            ->minValue(1),
                        Forms\Components\TextInput::make('weight')
                            ->numeric()
                            ->minValue(1)
                            ->hidden(fn (Forms\Get $get) => $get('book_type') !== 'fisik')
                            ->suffix('gram'),
                        Forms\Components\TextInput::make('dimensions')
                            ->placeholder('Contoh: 15x23 cm')
                            ->hidden(fn (Forms\Get $get) => $get('book_type') !== 'fisik')
                            ->maxLength(20),
                    ]),

                Forms\Components\Section::make('Harga & Stok')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('Rp'),
                        Forms\Components\TextInput::make('stock')
                            ->required()
                            ->numeric()
                            ->minValue(0),
                    ]),

                Forms\Components\Section::make('File')
                    ->schema([
                        Forms\Components\FileUpload::make('cover_image')
                            ->image()
                            ->directory('book-covers')
                            ->imageEditor(),
                        Forms\Components\FileUpload::make('pdf_file')
                            ->acceptedFileTypes(['application/pdf'])
                            ->directory('book-pdfs')
                            ->preserveFilenames()
                            ->visible(fn (Forms\Get $get) => $get('book_type') !== 'fisik'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover_image')
                    ->label('Cover'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('book_type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'fisik' => 'info',
                        'digital' => 'success',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'fisik' => 'Fisik',
                        'digital' => 'Digital',
                    }),
                Tables\Columns\TextColumn::make('author'),
                Tables\Columns\TextColumn::make('category'),
                Tables\Columns\TextColumn::make('price')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('stock')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('book_type')
                    ->options([
                        'fisik' => 'Fisik',
                        'digital' => 'Digital',
                    ]),
                Tables\Filters\SelectFilter::make('category')
                    ->options(fn (): array => Book::query()
                        ->distinct()
                        ->pluck('category', 'category')
                        ->filter()
                        ->toArray()),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                ->visible(fn (Book $record) => $record->transactionDetails()->count() === 0)
                ->before(function (Book $record) {
                    if ($record->transactionDetails()->exists()) {
                        throw new \Exception('Buku ini sudah digunakan dalam transaksi dan tidak dapat dihapus.');
                    }
                }),
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
            'create' => Pages\CreateBook::route('/create'),
            'edit' => Pages\EditBook::route('/{record}/edit'),
        ];
    }
}
