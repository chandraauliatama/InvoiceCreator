<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceResource\Pages;
use App\Filament\Resources\InvoiceResource\RelationManagers\InvoiceitemRelationManager;
use App\Models\Invoice;
use Closure;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?int $navigationSort = -2;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('worker_name')
                    ->dehydrateStateUsing(fn ($state) => ucwords($state))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('worker_email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('worker_phone')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('bill_to')
                    ->dehydrateStateUsing(fn ($state) => ucwords($state))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('bill_address')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('invoice_date')
                    ->required(),
                Forms\Components\TextInput::make('payment_link')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('ach_transfer')->inline(false)->label('ACH Transfer')
                    ->reactive(),
                Forms\Components\TextInput::make('ach_routing_number')
                    ->numeric()
                    ->hidden(fn (Closure $get) => $get('ach_transfer') == false)
                    ->required(fn (Closure $get) => $get('ach_transfer') == true),
                Forms\Components\TextInput::make('ach_account_number')
                    ->numeric()
                    ->hidden(fn (Closure $get) => $get('ach_transfer') == false)
                    ->required(fn (Closure $get) => $get('ach_transfer') == true),
                Forms\Components\TextInput::make('ach_account_address')
                    ->hidden(fn (Closure $get) => $get('ach_transfer') == false)
                    ->required(fn (Closure $get) => $get('ach_transfer') == true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('paid')->boolean()->sortable()
                    ->action(function ($record, $column) {
                        $name = $column->getName();
                        $record->update([$name => ! $record->$name]);
                    }),
                Tables\Columns\TextColumn::make('invoice_date')
                    ->date()->sortable(),
                Tables\Columns\TextColumn::make('worker_name')->wrap()->searchable(),
                Tables\Columns\TextColumn::make('worker_email'),
                Tables\Columns\TextColumn::make('worker_phone'),
                Tables\Columns\TextColumn::make('bill_to')->searchable(),
                Tables\Columns\TextColumn::make('bill_address')->wrap(),
                Tables\Columns\TextColumn::make('payment_link'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('paid')->default(false),
            ])
            ->actions([
                Tables\Actions\ReplicateAction::make()->button()->color('danger')
                    ->form([Forms\Components\DatePicker::make('invoice_date')->required()])
                    ->beforeReplicaSaved(function (Model $replica, array $data): void {
                        $replica->invoice_date = $data['invoice_date'];
                    }),
                Tables\Actions\EditAction::make()->button(),
                Tables\Actions\Action::make('Print')->button()->color('success')
                    ->url(fn (Invoice $record): string => route('print', $record))
                    ->openUrlInNewTab(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            InvoiceitemRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }
}
