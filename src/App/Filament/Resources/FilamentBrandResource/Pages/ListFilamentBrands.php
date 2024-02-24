<?php

namespace App\Filament\Resources\FilamentBrandResource\Pages;

use App\Filament\Resources\FilamentBrandResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFilamentBrands extends ListRecords
{
    protected static string $resource = FilamentBrandResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
