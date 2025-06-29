<?php

namespace App\Filament\Resources\FadhilReviewResource\Pages;

use App\Filament\Resources\FadhilReviewResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFadhilReviews extends ListRecords
{
    protected static string $resource = FadhilReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
