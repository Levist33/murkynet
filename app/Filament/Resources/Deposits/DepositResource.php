<?php

namespace App\Filament\Resources\Deposits;

use App\Notifications\DepositApprovedNotification;

use App\Filament\Resources\Deposits\Pages;

use App\Models\Deposit;
use App\Models\Transaction;
use App\Models\Wallet;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

use Filament\Resources\Resource;

use Filament\Schemas\Schema;

use Filament\Tables;
use Filament\Tables\Table;

class DepositResource extends Resource
{
    protected static ?string $model = Deposit::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-banknotes';

    protected static string|\UnitEnum|null $navigationGroup = 'Finance';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('currency')
                    ->required(),

                TextInput::make('network')
                    ->required(),

                TextInput::make('amount')
                    ->numeric()
                    ->required(),

                TextInput::make('wallet_address')
                    ->required(),

                TextInput::make('txid'),

                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ])
                    ->required(),

                Textarea::make('admin_note'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->searchable(),

                Tables\Columns\TextColumn::make('currency')
                    ->searchable(),

                Tables\Columns\TextColumn::make('network'),

                Tables\Columns\TextColumn::make('amount'),

                Tables\Columns\TextColumn::make('status')
                    ->badge(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),

            ])

            ->actions([

                /*
                |--------------------------------------------------------------------------
                | Approve Deposit
                |--------------------------------------------------------------------------
                */

                \Filament\Actions\Action::make('approve')

                    ->color('success')

                    ->requiresConfirmation()

                    ->visible(fn ($record) => $record->status === 'pending')

                    ->action(function ($record) {

                        /*
                        |--------------------------------------------------------------------------
                        | Find Or Create Wallet
                        |--------------------------------------------------------------------------
                        */

                        $wallet = Wallet::firstOrCreate(
                            ['user_id' => $record->user_id],
                            ['balance' => 0]
                        );

                        /*
                        |--------------------------------------------------------------------------
                        | Credit Wallet
                        |--------------------------------------------------------------------------
                        */

                        $wallet->increment('balance', $record->amount);

                        /*
                        |--------------------------------------------------------------------------
                        | Send Notification
                        |--------------------------------------------------------------------------
                        */

                        $record->user->notify(
                            new DepositApprovedNotification($record->amount)
                        );

                        /*
                        |--------------------------------------------------------------------------
                        | Save Transaction
                        |--------------------------------------------------------------------------
                        */

                        Transaction::create([

                            'user_id' => $record->user_id,

                            'amount' => $record->amount,

                            'type' => 'deposit',

                            'description' => 'Crypto deposit approved',

                        ]);

                        /*
                        |--------------------------------------------------------------------------
                        | Update Deposit Status
                        |--------------------------------------------------------------------------
                        */

                        $record->update([
                            'status' => 'approved',
                        ]);
                    }),

                /*
                |--------------------------------------------------------------------------
                | Reject Deposit
                |--------------------------------------------------------------------------
                */

                \Filament\Actions\Action::make('reject')

                    ->color('danger')

                    ->requiresConfirmation()

                    ->visible(fn ($record) => $record->status === 'pending')

                    ->action(function ($record) {

                        $record->update([
                            'status' => 'rejected',
                        ]);
                    }),

                /*
                |--------------------------------------------------------------------------
                | Edit Deposit
                |--------------------------------------------------------------------------
                */

                \Filament\Actions\EditAction::make(),

            ]);
    }

    public static function getPages(): array
    {
        return [

            'index' => Pages\ListDeposits::route('/'),

            'create' => Pages\CreateDeposit::route('/create'),

            'edit' => Pages\EditDeposit::route('/{record}/edit'),

        ];
    }
}