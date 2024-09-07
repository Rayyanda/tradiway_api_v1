<?php

namespace App\Filament\Resources\HerbalPlantResource\Pages;

use App\Filament\Resources\HerbalPlantResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHerbalPlants extends ListRecords
{
    protected static string $resource = HerbalPlantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
