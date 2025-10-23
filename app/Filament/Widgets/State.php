<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Book;
use App\Models\Article;
use App\Models\User;
class State extends BaseWidget
{
    protected function getStats(): array
    {
        return [
             Stat::make('Book', Book::count())
              ->description('total book')
                ->descriptionIcon('heroicon-m-newspaper')
                ->chart([30,90,666,333,22,11,0])
                ->color('success'),
             Stat::make('Article', Article::count())
              ->description('total article')
                ->descriptionIcon('heroicon-m-radio')
                ->chart([30,9,66,0,22,11,0])
                ->color('danger'),
            Stat::make('User', User::count())
              ->description('total user')
                ->descriptionIcon('heroicon-m-user')
                ->chart([30,9,0,0,22,11,0])
                ->color('primary')
        ];
    }
}
