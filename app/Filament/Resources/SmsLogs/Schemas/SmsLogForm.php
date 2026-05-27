<?php

namespace App\Filament\Resources\SmsLogs\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SmsLogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('sender_id_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('recipient')
                    ->required(),
                Textarea::make('message')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('route')
                    ->default(null),
                TextInput::make('cost')
                    ->required()
                    ->numeric()
                    ->default(0.0)
                    ->prefix('$'),
                TextInput::make('status')
                    ->required()
                    ->default('pending'),
                DateTimePicker::make('sent_at'),
            ]);
    }
}
