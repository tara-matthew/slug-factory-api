<?php

namespace App\Filament\Resources\FilamentColourResource\Pages;

use App\Filament\Resources\FilamentColourResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFilamentColour extends EditRecord
{
    protected static string $resource = FilamentColourResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
