<?php

namespace App\Filament\Resources\Senderids\Pages;

use App\Filament\Resources\Senderids\SenderidResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSenderids extends ListRecords
{
    protected static string $resource = SenderidResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
