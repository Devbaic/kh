<?php

namespace App\Filament\Resources\BestResource\Pages;

use App\Filament\Resources\BestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBest extends EditRecord
{
    protected static string $resource = BestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
