<?php

namespace App\Filament\Resources\HerbalPlantResource\Pages;

use App\Filament\Resources\HerbalPlantResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHerbalPlant extends EditRecord
{
    protected static string $resource = HerbalPlantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
