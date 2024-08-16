<?php

namespace App\Filament\Resources\HerbalDrinkResource\Pages;

use App\Filament\Resources\HerbalDrinkResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHerbalDrink extends EditRecord
{
    protected static string $resource = HerbalDrinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
