<?php

namespace App\Filament\Resources\InvoiceResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class InvoiceitemRelationManager extends RelationManager
{
    protected static string $relationship = 'invoiceitem';

    protected static ?string $modelLabel = 'Invoice Item';

    protected static ?string $pluralModelLabel = 'Invoice Items';

    // protected static ?string $recordTitleAttribute = 'work_description';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('work_description')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('start_date')
                    ->required()->default(now()),
                Forms\Components\DatePicker::make('complete_date')
                    ->required()->default(now()),
                Forms\Components\TextInput::make('days_worked')
                    ->numeric()->default(1)
                    ->required(),
                Forms\Components\TextInput::make('pay_per_day')
                    ->numeric()->default(12)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
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
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['invoice_id'] = request()->segment(3);

                        return $data;
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
