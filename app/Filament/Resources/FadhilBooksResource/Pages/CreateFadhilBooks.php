<?php

namespace App\Filament\Resources\FadhilBooksResource\Pages;

use App\Filament\Resources\FadhilBooksResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFadhilBooks extends CreateRecord
{
    protected static string $resource = FadhilBooksResource::class;

    //redirect to index
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
