<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HerbalDrinkResource\Pages;
use App\Filament\Resources\HerbalDrinkResource\RelationManagers;
use App\Models\HerbalDrink;
use Doctrine\DBAL\Schema\Column;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HerbalDrinkResource extends Resource
{
    protected static ?string $model = HerbalDrink::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\RichEditor::make('description')
                    ->required(),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->visibility('public')
                    ->directory('/images/drinks')
                    ->required(),
                Forms\Components\Textarea::make('benefits')
                    ->required(),
                Forms\Components\TextInput::make('category')
                    ->nullable()
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
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
            'index' => Pages\ListHerbalDrinks::route('/'),
            'create' => Pages\CreateHerbalDrink::route('/create'),
            'edit' => Pages\EditHerbalDrink::route('/{record}/edit'),
        ];
    }
}
