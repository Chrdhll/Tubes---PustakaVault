<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FadhilLoanResource\Pages;
use App\Filament\Resources\FadhilLoanResource\RelationManagers;
use App\Models\FadhilLoan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FadhilLoanResource extends Resource
{
    protected static ?string $model = FadhilLoan::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-arrow-down';

    protected static ?string $navigationLabel = 'Loans';

    protected static ?string $slug = 'loans';

    public static ?string $label = 'Loan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('book_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('loan_date')
                    ->required(),
                Forms\Components\DatePicker::make('due_date')
                    ->required(),
                Forms\Components\DatePicker::make('return_date'),
                Forms\Components\Select::make('status')
                    ->options([
                        'borrowed' => 'Dipinjam',
                        'returned' => 'Dikembalikan',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('fine_amount')
                    ->required()
                    ->numeric()
                    ->default(0.00),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('book.title')
                    ->searchable()
                    ->label('Book Title')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable()
                    ->label('User Name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('loan_date')
                    ->date()
                    ->date('d M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('due_date')
                    ->date()
                    ->date('d M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('return_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')->badge()->color(fn(string $state): string => match ($state) {
                    'borrowed' => 'warning',
                    'returned' => 'success',
                }),
                Tables\Columns\TextColumn::make('current_fine') // Panggil nama accessor (tanpa get...Attribute)
                    ->label('Denda Saat Ini')
                    ->numeric()
                    ->default(0.00)
                    ->prefix('Rp')
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
            ])
            ->defaultSort('created_at', 'desc')
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
            'index' => Pages\ListFadhilLoans::route('/'),
            'create' => Pages\CreateFadhilLoan::route('/create'),
            'edit' => Pages\EditFadhilLoan::route('/{record}/edit'),
        ];
    }
}
