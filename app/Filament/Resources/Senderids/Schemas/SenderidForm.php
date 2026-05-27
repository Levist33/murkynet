<?php

namespace App\Filament\Resources\Senderids\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SenderidForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('sender_id')
                    ->required(),
                TextInput::make('country')
                    ->default(null),
                TextInput::make('status')
                    ->required()
                    ->default('pending'),
                Toggle::make('active')
                    ->required(),
            ]);
    }
}
