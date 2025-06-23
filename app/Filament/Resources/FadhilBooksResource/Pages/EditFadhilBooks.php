<?php

namespace App\Filament\Resources\FadhilBooksResource\Pages;

use App\Filament\Resources\FadhilBooksResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFadhilBooks extends EditRecord
{
    protected static string $resource = FadhilBooksResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
