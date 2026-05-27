<?php

namespace App\Filament\Resources\Cryptowallets\Pages;

use App\Filament\Resources\Cryptowallets\CryptowalletResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCryptowallets extends ListRecords
{
    protected static string $resource = CryptowalletResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
