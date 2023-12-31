<?php

namespace App\Filament\Resources\ColorResource\Pages;

use App\Filament\Resources\ColorResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageColors extends ManageRecords
{
    protected static string $resource = ColorResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
