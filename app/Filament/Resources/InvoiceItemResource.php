<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceItemResource\Pages;
use App\Models\InvoiceItem;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class InvoiceItemResource extends Resource
{
    protected static ?string $model = InvoiceItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('invoice_id')
                    ->relationship('invoice', 'invoice_date')
                    ->required(),
                Forms\Components\TextInput::make('work_description')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('start_date')
                    ->required(),
                Forms\Components\DatePicker::make('complete_date')
                    ->required(),
                Forms\Components\TextInput::make('days_worked')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('pay_per_day')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('invoice.invoice_date')
                    ->date()->sortable()
                    ->url(fn ($record) => InvoiceResource::getUrl('edit', ['record' => $record->invoice_id])),
                Tables\Columns\TextColumn::make('work_description')->wrap()->searchable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()->sortable(),
                Tables\Columns\TextColumn::make('complete_date')
                    ->date()->sortable(),
                Tables\Columns\TextColumn::make('days_worked')->suffix(' day')->sortable(),
                Tables\Columns\TextColumn::make('pay_per_day')->prefix('$'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('Invoice Date')
                    ->relationship('invoice', 'invoice_date', fn (Builder $query) => $query),
                Tables\Filters\SelectFilter::make('Worker Name')
                    ->relationship('invoice', 'worker_name', fn (Builder $query) => $query),
                Tables\Filters\SelectFilter::make('Bill To')
                    ->relationship('invoice', 'bill_to', fn (Builder $query) => $query),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInvoiceItems::route('/'),
            'create' => Pages\CreateInvoiceItem::route('/create'),
            'edit' => Pages\EditInvoiceItem::route('/{record}/edit'),
        ];
    }
}
