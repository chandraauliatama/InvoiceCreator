<?php

namespace App\Filament\Resources\InvoiceItemResource\Pages;

use App\Filament\Resources\InvoiceItemResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInvoiceItem extends EditRecord
{
    protected static string $resource = InvoiceItemResource::class;

    protected function getActions(): array
    {
        return [
            Actions\Action::make('See Invoice')->button()
                ->url(fn () => route('filament.resources.invoices.edit', $this->record->invoice_id)),
            Actions\DeleteAction::make(),
        ];
    }
}
