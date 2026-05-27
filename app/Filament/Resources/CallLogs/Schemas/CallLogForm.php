<?php

namespace App\Filament\Resources\CallLogs\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CallLogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('caller_id_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('phone')
                    ->tel()
                    ->required(),
                TextInput::make('duration')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('cost')
                    ->required()
                    ->numeric()
                    ->default(0.0)
                    ->prefix('$'),
                Select::make('status')
                    ->options([
            'initiated' => 'Initiated',
            'ringing' => 'Ringing',
            'answered' => 'Answered',
            'failed' => 'Failed',
            'completed' => 'Completed',
        ])
                    ->default('initiated')
                    ->required(),
                TextInput::make('provider')
                    ->default(null),
                TextInput::make('provider_call_id')
                    ->default(null),
            ]);
    }
}
