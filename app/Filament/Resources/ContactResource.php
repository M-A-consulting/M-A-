<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Forms\Components\TextInput::make('first_name')
                        ->required()
                        ->label('First Name'),
                    Forms\Components\TextInput::make('last_name')
                        ->required()
                        ->label('Last Name'),
                    Forms\Components\TextInput::make('company_name')
                        ->label('Company Name'),
                    Forms\Components\TextInput::make('position')
                        ->required()
                        ->label('Position'),
                    Forms\Components\TextInput::make('phone_number')
                        ->required()
                        ->label('Phone Number'),
                    Forms\Components\TextInput::make('email')
                        ->required()
                        ->email()
                        ->label('Email Address'),
                    Forms\Components\TextInput::make('topic')
                        ->required()
                        ->label('Topic'),
                    Forms\Components\Textarea::make('short_message')
                        ->required()
                        ->label('Short Message'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')->label('First Name'),
                Tables\Columns\TextColumn::make('last_name')->label('Last Name'),
                Tables\Columns\TextColumn::make('company_name')->label('Company Name')->sortable(),
                Tables\Columns\TextColumn::make('position')->label('Position'),
                Tables\Columns\TextColumn::make('email')->label('Email Address'),
                Tables\Columns\TextColumn::make('topic')->label('Topic'),
                Tables\Columns\TextColumn::make('created_at')->label('Submitted At')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
