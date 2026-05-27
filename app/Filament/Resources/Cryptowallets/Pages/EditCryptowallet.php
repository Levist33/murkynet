<?php

namespace App\Filament\Resources\Cryptowallets\Pages;

use App\Filament\Resources\Cryptowallets\CryptowalletResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCryptowallet extends EditRecord
{
    protected static string $resource = CryptowalletResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
