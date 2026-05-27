<?php

namespace App\Filament\Resources\Callerids\Pages;

use App\Filament\Resources\Callerids\CalleridResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCallerids extends ListRecords
{
    protected static string $resource = CalleridResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
