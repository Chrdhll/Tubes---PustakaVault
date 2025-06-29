<?php

namespace App\Filament\Resources\FadhilReviewResource\Pages;

use App\Filament\Resources\FadhilReviewResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFadhilReview extends CreateRecord
{
    protected static string $resource = FadhilReviewResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
