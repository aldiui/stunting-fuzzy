<?php

namespace App\Filament\Resources\KalkulatorFuzzyResource\Pages;

use App\Filament\Resources\KalkulatorFuzzyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKalkulatorFuzzy extends EditRecord
{
    protected static string $resource = KalkulatorFuzzyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
