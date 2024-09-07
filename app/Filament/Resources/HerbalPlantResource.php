<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HerbalPlantResource\Pages;
use App\Filament\Resources\HerbalPlantResource\RelationManagers;
use App\Models\HerbalPlant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HerbalPlantResource extends Resource
{
    protected static ?string $model = HerbalPlant::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\Select::make('drink_id')
                    ->relationship('drinks','name')
                    ->required(),
                Forms\Components\Select::make('plant_id')
                    ->relationship('plants','name')
                    ->required(),
                Forms\Components\TextInput::make('measurement')
                    ->placeholder('1 sdm')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\ImageColumn::make('drinks.image'),
                Tables\Columns\TextColumn::make('drinks.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('plants.name')
                    ->searchable(),
                    
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHerbalPlants::route('/'),
            'create' => Pages\CreateHerbalPlant::route('/create'),
            'edit' => Pages\EditHerbalPlant::route('/{record}/edit'),
        ];
    }
}
