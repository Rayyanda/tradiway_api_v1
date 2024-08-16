<?php

namespace App\Filament\Resources\HerbalDrinkResource\Pages;

use App\Filament\Resources\HerbalDrinkResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHerbalDrinks extends ListRecords
{
    protected static string $resource = HerbalDrinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
