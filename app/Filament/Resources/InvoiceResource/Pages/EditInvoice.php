<?php

namespace App\Filament\Resources\InvoiceResource\Pages;

use App\Filament\Resources\InvoiceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInvoice extends EditRecord
{
    protected static string $resource = InvoiceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\Action::make('Print Invoice')->button()
                ->url(fn () => route('print', $this->record))
                ->openUrlInNewTab(),
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
