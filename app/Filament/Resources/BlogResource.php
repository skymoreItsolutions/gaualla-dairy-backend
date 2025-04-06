<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Filament\Resources\BlogResource\RelationManagers;
use App\Models\Blog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static ?string $navigationIcon = 'heroicon-o-bold';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
            ->required()
            ->live()
            ->afterStateUpdated(fn ($state, callable $set) => 
                $set('slug', \Illuminate\Support\Str::slug($state))
            ),

        TextInput::make('slug')
            ->disabled()
            ->dehydrated() // Ensures it still gets saved
            ->unique(ignoreRecord: true),

        Textarea::make('content')
            ->required()
            ->columnSpanFull(),

        FileUpload::make('thumbnail')
            ->image()
            ->directory('blog-thumbnails')
            ->nullable(),

        TextInput::make('author')
            ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->sortable()->searchable(),
                TextColumn::make('content')->copyable(),

                TextColumn::make('slug')->copyable(),
        
                ImageColumn::make('thumbnail')
                    ->label('Thumbnail')
                    ->square(),
        
                TextColumn::make('author')->sortable(),
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
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }
}
