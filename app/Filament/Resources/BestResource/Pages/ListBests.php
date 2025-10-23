<?php

namespace App\Filament\Resources\BestResource\Pages;

use App\Filament\Resources\BestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBests extends ListRecords
{
    protected static string $resource = BestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
