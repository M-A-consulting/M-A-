<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingsResource\Pages;
use App\Filament\Resources\SettingsResource\RelationManagers;
use App\Models\Settings;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SettingsResource extends Resource
{
    protected static ?string $model = Settings::class;
    protected static ?string $navigationLabel = 'Company Settings';
    protected static ?string $navigationIcon = 'heroicon-o-cog';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('company_name')->required(),
                Forms\Components\FileUpload::make('logo')->nullable()->image(),
                Forms\Components\Textarea::make('about')->nullable(),
                Forms\Components\DatePicker::make('founded_date')->nullable(),
                Forms\Components\TextInput::make('email')->nullable()->email(),
                Forms\Components\TextInput::make('phone')->nullable(),
                Forms\Components\Textarea::make('address')->nullable(),
                Forms\Components\Textarea::make('social_links')->nullable(),
                Forms\Components\Textarea::make('services_offered')->nullable(),
                Forms\Components\Textarea::make('clients')->nullable(),
                Forms\Components\Textarea::make('testimonials')->nullable(),
                Forms\Components\Textarea::make('awards')->nullable(),
                Forms\Components\Textarea::make('team_members')->nullable(),
                Forms\Components\TextInput::make('founder')->nullable(),
                Forms\Components\Textarea::make('certifications')->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('company_name')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('phone')->searchable(),
                Tables\Columns\TextColumn::make('founded_date')->date(),
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
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSettings::route('/create'),
            'edit' => Pages\EditSettings::route('/{record}/edit'),
        ];
    }
}
