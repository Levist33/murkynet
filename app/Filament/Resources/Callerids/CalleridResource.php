<?php

namespace App\Filament\Resources\CallerIds;

use App\Filament\Resources\CallerIds\Pages;

use App\Models\CallerId;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

use Filament\Resources\Resource;

use Filament\Schemas\Schema;

use Filament\Tables;
use Filament\Tables\Table;

class CallerIdResource extends Resource
{
    protected static ?string $model = CallerId::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-phone';

    protected static string|\UnitEnum|null $navigationGroup = 'Calling';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('caller_id')
                    ->required(),

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

                Tables\Columns\TextColumn::make('caller_id')
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
            'index' => Pages\ListCallerIds::route('/'),
            'create' => Pages\CreateCallerId::route('/create'),
            'edit' => Pages\EditCallerId::route('/{record}/edit'),
        ];
    }
}