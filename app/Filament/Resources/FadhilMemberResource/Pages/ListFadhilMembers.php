<?php

namespace App\Filament\Resources\FadhilMemberResource\Pages;

use App\Filament\Resources\FadhilMemberResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFadhilMembers extends ListRecords
{
    protected static string $resource = FadhilMemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
