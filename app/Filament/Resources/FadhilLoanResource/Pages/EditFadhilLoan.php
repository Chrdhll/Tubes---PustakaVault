<?php

namespace App\Filament\Resources\FadhilLoanResource\Pages;

use Carbon\Carbon;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\FadhilLoanResource;

class EditFadhilLoan extends EditRecord
{
    protected static string $resource = FadhilLoanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}