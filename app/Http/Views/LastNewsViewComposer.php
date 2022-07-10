<?php


namespace App\Http\Views;

use App\Models\Post;

class LastNewsViewComposer
{
    private $model;

    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    public function compose($view)
    {
        $last_news = $this->model->whereStatus(1)
            ->whereDate('published_at', '<=', date('Y-m-d'))
            ->where('highlight', 0)
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();
        return $view->with('last_news',  $last_news);
    }
}
