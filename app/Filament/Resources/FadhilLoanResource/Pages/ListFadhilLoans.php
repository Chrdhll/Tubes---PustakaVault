<?php

namespace App\Filament\Resources\FadhilLoanResource\Pages;

use App\Filament\Resources\FadhilLoanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFadhilLoans extends ListRecords
{
    protected static string $resource = FadhilLoanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
