<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShoeResource\Pages;
use App\Filament\Resources\ShoeResource\RelationManagers;
use App\Models\Shoe;
use FFI;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ShoeResource extends Resource
{
    protected static ?string $model = Shoe::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Details')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('Rp'),

                        FileUpload::make('thumbnail')
                            ->required()
                            ->image()
                            ->columnSpanFull(),

                        Repeater::make('photos')
                            ->relationship('photos')
                            ->schema([
                                FileUpload::make('photo')
                                    ->required(),
                            ])
                            ->columnSpanFull(),

                        Repeater::make('sizes')
                            ->relationship('sizes')
                            ->schema([
                                TextInput::make('size')
                                    ->required(),
                            ])
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Fieldset::make('Additional')
                    ->schema([


                        Select::make('brand_id')
                            ->relationship('brand', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('category_id')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('is_popular')
                            ->label('Select Popular')
                            ->options([
                                true => 'Popular',
                                false => 'Not Popular',
                            ])
                            ->required()
                            ->native(false),

                        TextInput::make('stock')
                            ->required()
                            ->numeric()
                            ->prefix('Qty'),

                        Textarea::make('about')
                            ->required()
                            ->rows(6)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),

                TextColumn::make('price')
                    ->label('Harga')
                    ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.')),

                TextColumn::make('category.name'),

                ImageColumn::make('thumbnail'),

                IconColumn::make('is_popular')
                    ->label('Popular')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-xx-circle'),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->native(false),

                SelectFilter::make('brand_id')
                    ->label('Brand')
                    ->relationship('brand', 'name')
                    ->native(false),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShoes::route('/'),
            'create' => Pages\CreateShoe::route('/create'),
            'edit' => Pages\EditShoe::route('/{record}/edit'),
        ];
    }
}
