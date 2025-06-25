<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\FadhilBooks;
use Filament\Resources\Resource;
use Filament\Forms\Components\Tabs\Tab;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\FadhilBooksResource\Pages;
use App\Filament\Resources\FadhilBooksResource\RelationManagers;
use Filament\Tables\Columns\ImageColumn;

class FadhilBooksResource extends Resource
{
    protected static ?string $model = FadhilBooks::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';   

    protected static ?string $navigationLabel = 'Books';

    protected static ?string $slug = 'books';

    public static ?string $label = 'Book';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('author')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('publisher')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('blurb'),
                Forms\Components\TextInput::make('stock')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->default(0),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->directory('books')
                    ->disk('public')
                    ->visibility('public')
                    ->required()
                    ->imageResizeMode('cover'),

                Forms\Components\TextInput::make('year')
                    ->required(),
                Forms\Components\select::make('category_id')
                    ->relationship('category', 'name')
                    ->label('Category')
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('author')
                    ->searchable(),
                Tables\Columns\TextColumn::make('publisher')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('blurb'),
                Tables\Columns\TextColumn::make('stock')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image')
                    ->disk('public')
                    ->defaultImageUrl(url('/placeholder.jpg'))
                    ->circular()
                    ->label('Cover')
                    ->visibility('public'),
                Tables\Columns\TextColumn::make('year'),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListFadhilBooks::route('/'),
            'create' => Pages\CreateFadhilBooks::route('/create'),
            'edit' => Pages\EditFadhilBooks::route('/{record}/edit'),
        ];
    }
}

