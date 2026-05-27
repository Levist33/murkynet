<?php

namespace App\Filament\Resources\Senderids\Pages;

use App\Filament\Resources\Senderids\SenderidResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSenderid extends EditRecord
{
    protected static string $resource = SenderidResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
