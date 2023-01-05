<?php

namespace App\Filament\Resources\InvoiceResource\Pages;

use App\Filament\Resources\InvoiceResource;
use App\Models\Invoice;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInvoice extends EditRecord
{
    protected static string $resource = InvoiceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\Action::make('Print Invoice')->button()
                ->url(fn() => route('print', $this->record))
                ->openUrlInNewTab(),
            Actions\DeleteAction::make(),
        ];
    }
}
