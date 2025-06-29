<?php

namespace App\Filament\Resources\FadhilCategoryResource\Pages;

use App\Filament\Resources\FadhilCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFadhilCategory extends CreateRecord
{
    protected static string $resource = FadhilCategoryResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
