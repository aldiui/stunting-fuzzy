<?php

namespace App\Filament\Resources\IndexFuzzyResource\Pages;

use App\Filament\Resources\IndexFuzzyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIndexFuzzy extends EditRecord
{
    protected static string $resource = IndexFuzzyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
