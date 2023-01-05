<?php

namespace App\Filament\Resources\InvoiceItemResource\Pages;

use App\Filament\Resources\InvoiceItemResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInvoiceItems extends ListRecords
{
    protected static string $resource = InvoiceItemResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('New Invoice')->url('/admin/invoices/create', true)->color('success'),
        ];
    }
}
