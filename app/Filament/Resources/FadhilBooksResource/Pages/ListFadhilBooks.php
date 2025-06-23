<?php

namespace App\Filament\Resources\FadhilBooksResource\Pages;

use App\Filament\Resources\FadhilBooksResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFadhilBooks extends ListRecords
{
    protected static string $resource = FadhilBooksResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
