<?php

namespace App\Filament\Resources\KalkulatorFuzzyResource\Pages;

use App\Filament\Resources\KalkulatorFuzzyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKalkulatorFuzzies extends ListRecords
{
    protected static string $resource = KalkulatorFuzzyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
