<?php

namespace App\Filament\Resources\Senderids;

use App\Filament\Resources\Senderids\Pages;

use App\Models\Senderid;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

use Filament\Resources\Resource;

use Filament\Schemas\Schema;

use Filament\Tables;
use Filament\Tables\Table;

class SenderidResource extends Resource
{
    protected static ?string $model = Senderid::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-identification';

    protected static string|\UnitEnum|null $navigationGroup = 'Messaging';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('sender_id')
                    ->required()
                    ->maxLength(11),

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

                Tables\Columns\TextColumn::make('sender_id')
                    ->searchable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),

            ])
            ->actions([

                \Filament\Actions\Action::make('approve')

                    ->color('success')

                    ->requiresConfirmation()

                    ->visible(fn ($record) => $record->status === 'pending')

                    ->action(function ($record) {

                        $record->update([
                            'status' => 'approved',
                        ]);
                    }),

                \Filament\Actions\Action::make('reject')

                    ->color('danger')

                    ->requiresConfirmation()

                    ->visible(fn ($record) => $record->status === 'pending')

                    ->action(function ($record) {

                        $record->update([
                            'status' => 'rejected',
                        ]);
                    }),

                \Filament\Actions\EditAction::make(),

            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSenderids::route('/'),
            'create' => Pages\CreateSenderid::route('/create'),
            'edit' => Pages\EditSenderid::route('/{record}/edit'),
        ];
    }
}