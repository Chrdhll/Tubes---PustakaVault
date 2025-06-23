<?php

namespace App\Filament\Resources\FadhilCategoryResource\Pages;

use App\Filament\Resources\FadhilCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFadhilCategory extends EditRecord
{
    protected static string $resource = FadhilCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
