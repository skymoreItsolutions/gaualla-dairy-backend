<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use App\Models\ProductType;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),

                FileUpload::make('images')
                    ->label('Images')
                    ->multiple()
                    ->reorderable()
                    ->directory('products')
                    ->preserveFilenames()
                    ->image()
                    ->nullable(),
        
                TextInput::make('quantity')
                    ->numeric()
                    ->required(),
        
                Select::make('quantity_type')
                    ->options([
                        'g'=>'gram',
                        'kg' => 'Kilogram',
                        'pcs' => 'Pieces',
                        'ltr' => 'Liter',
                        'box' => 'Box',
                    ])
                    ->required(),
        
                TextInput::make('price')
                    ->numeric()
                    ->prefix('₹')
                    ->required(),
        

                Select::make('type')
         ->label('Product Type')
    ->options(fn () => ProductType::pluck('title', 'title')) // [value => label]
    ->searchable()
    ->required(),
        
                
        
                Toggle::make('status')
                    ->label('status')
                    ->default(true),
        
                TextInput::make('rating')
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
               
        TextColumn::make('name')->sortable()->searchable(),

        ImageColumn::make('images')
            ->label('Image')
            ->limit(1),

        TextColumn::make('quantity'),
        TextColumn::make('quantity_type'),
        TextColumn::make('price')->money('inr'),
        TextColumn::make('type'),
        // TextColumn::make('status'),
        IconColumn::make('status')->boolean(),
        TextColumn::make('rating'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
