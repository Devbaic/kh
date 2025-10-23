<?php

namespace App\Livewire;
use App\Models\Article;
use App\Models\Banner;
use Livewire\Component;
use App\Models\Book;
use App\Models\Popular;
use App\Models\Best;
class Homepage extends Component
{
    public function render()
    {
    $fire = Best::orderBy('month', 'DESC')->get();
    $book = Book::orderBy('name', 'ASC')->get();
    $banner = Banner::orderBy('title', 'ASC')->get();
    $article = Article::orderBy('title', 'ASC')->get();
    return view('livewire.homepage', [
        'banner' => $banner,
        'book' => $book,
        'fire' => $fire,
        'article'=>$article,
    ]);

    }
}
