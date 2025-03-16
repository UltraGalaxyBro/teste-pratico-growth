<?php

namespace App\Filament\Resources;

use App\Enums\Status;
use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'Produtos';

    public static function form(Form $form): Form
    {
        //Tô puxando as regras de validações estabelecidas lá na model
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome')
                    ->rules(Product::getValidationRules()['nome']),
                Forms\Components\Textarea::make('descricao')
                    ->rules(Product::getValidationRules()['descricao']),
                Forms\Components\TextInput::make('preco')
                    ->numeric()
                    ->rules(Product::getValidationRules()['preco']),
                Forms\Components\Select::make('status')
                    ->options([
                        Status::ATIVO->value => Status::ATIVO->getLabel(),
                        Status::INATIVO->value => Status::INATIVO->getLabel(),
                    ])
                    ->rules(Product::getValidationRules()['status']),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('descricao')
                    ->limit(50),
                Tables\Columns\TextColumn::make('preco')
                    ->money('BRL')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn(Status $state): string => $state->getLabel())
                    ->color(fn(Status $state): string => match ($state) {
                        Status::ATIVO => 'success',
                        Status::INATIVO => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->searchDebounce('500ms')
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                SelectFilter::make('status')
                    ->options([
                        Status::ATIVO->value => Status::ATIVO->getLabel(),
                        Status::INATIVO->value => Status::INATIVO->getLabel(),
                    ])
                    ->label('Status')
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
