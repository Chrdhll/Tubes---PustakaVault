<?php

namespace App\Filament\Resources\FadhilLoanResource\Pages;

use App\Filament\Resources\FadhilLoanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFadhilLoan extends EditRecord
{
    protected static string $resource = FadhilLoanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
