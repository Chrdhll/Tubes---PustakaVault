<?php

namespace App\Filament\Resources\FadhilCategoryResource\Pages;

use App\Filament\Resources\FadhilCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFadhilCategories extends ListRecords
{
    protected static string $resource = FadhilCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
