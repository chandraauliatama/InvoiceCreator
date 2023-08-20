<?php

namespace App\Filament\Resources\InvoiceResource\Pages;

use App\Filament\Resources\InvoiceResource;
use Filament\Actions\Action;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInvoice extends EditRecord
{
    protected static string $resource = InvoiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('Print Invoice')->button()
                ->action(fn () => InvoiceResource::printInvoice($this->record)),
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if ($data['ach_transfer'] == false) {
            $data['ach_account_number'] = null;
            $data['ach_routing_number'] = null;
            $data['ach_account_address'] = null;
        }

        return $data;
    }
}
