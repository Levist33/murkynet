<?php

namespace App\Filament\Resources\Callerids\Pages;

use App\Filament\Resources\Callerids\CalleridResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCallerid extends EditRecord
{
    protected static string $resource = CalleridResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
