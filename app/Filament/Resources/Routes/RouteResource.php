<?php

namespace App\Filament\Resources\Routes;

use App\Filament\Resources\Routes\Pages\CreateRoute;
use App\Filament\Resources\Routes\Pages\EditRoute;
use App\Filament\Resources\Routes\Pages\ListRoutes;
use App\Models\Route;

use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;

use Filament\Tables;
use Filament\Tables\Table;

class RouteResource extends Resource
{
    protected static ?string $model = Route::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-globe-alt';

    protected static ?string $navigationLabel = 'Routes';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([

                Forms\Components\TextInput::make('country')
                    ->required(),

                Forms\Components\TextInput::make('route_name')
                    ->required(),

                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->required(),

                Forms\Components\Toggle::make('active')
                    ->default(true),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('country')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('route_name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->sortable(),

                Tables\Columns\IconColumn::make('active')
                    ->boolean(),

            ])

            ->filters([
                //
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRoutes::route('/'),
            'create' => CreateRoute::route('/create'),
            'edit' => EditRoute::route('/{record}/edit'),
        ];
    }
}