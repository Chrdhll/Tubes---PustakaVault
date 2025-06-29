<?php

namespace App\Filament\Resources\FadhilReviewResource\Pages;

use App\Filament\Resources\FadhilReviewResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFadhilReview extends EditRecord
{
    protected static string $resource = FadhilReviewResource::class;

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
