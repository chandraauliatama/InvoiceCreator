<?php

namespace App\Filament\Resources\InvoiceItemResource\Pages;

use App\Filament\Resources\InvoiceItemResource;
use Filament\Resources\Pages\CreateRecord;

class CreateInvoiceItem extends CreateRecord
{
    protected static string $resource = InvoiceItemResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
}
