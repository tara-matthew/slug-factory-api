<?php

namespace App\Filament\Resources\FilamentColourResource\Pages;

use App\Filament\Resources\FilamentColourResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFilamentColours extends ListRecords
{
    protected static string $resource = FilamentColourResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
