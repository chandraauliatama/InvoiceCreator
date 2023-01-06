<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceResource\Pages;
use App\Filament\Resources\InvoiceResource\RelationManagers\InvoiceitemRelationManager;
use App\Models\Invoice;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

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
                Tables\Filters\TernaryFilter::make('paid'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            InvoiceitemRelationManager::class
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
