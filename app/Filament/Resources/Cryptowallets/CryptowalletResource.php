<?php

namespace App\Filament\Resources\CryptoWallets;

use App\Filament\Resources\CryptoWallets\Pages;
use App\Models\CryptoWallet;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables;
use Filament\Tables\Table;

class CryptoWalletResource extends Resource
{
    protected static ?string $model = CryptoWallet::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-wallet';

    protected static string|\UnitEnum|null $navigationGroup = 'Finance';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('currency')
                    ->options([
                        'USDT' => 'USDT',
                        'BTC' => 'BTC',
                        'ETH' => 'ETH',
                        'BNB' => 'BNB',
                        'SOL' => 'SOL',
                        'LTC' => 'LTC',
                    ])
                    ->required(),

                Select::make('network')
                    ->options([
                        'TRC20' => 'TRC20',
                        'ERC20' => 'ERC20',
                        'BEP20' => 'BEP20',
                        'BTC' => 'BTC',
                        'SOL' => 'SOL',
                    ])
                    ->required(),

                Textarea::make('wallet_address')
                    ->required()
                    ->rows(4),

                Toggle::make('is_active')
                    ->default(true),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('currency')
                    ->searchable(),

                Tables\Columns\TextColumn::make('network')
                    ->searchable(),

                Tables\Columns\TextColumn::make('wallet_address')
                    ->limit(40),

                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),

            ])
            ->actions([

                \Filament\Actions\EditAction::make(),

            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCryptoWallets::route('/'),
            'create' => Pages\CreateCryptoWallet::route('/create'),
            'edit' => Pages\EditCryptoWallet::route('/{record}/edit'),
        ];
    }
}