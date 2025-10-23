<?php

namespace App\Filament\Resources\PopularResource\Pages;

use App\Filament\Resources\PopularResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPopulars extends ListRecords
{
    protected static string $resource = PopularResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
