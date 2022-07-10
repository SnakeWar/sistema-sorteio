<?php


namespace App\Http\Views;

use App\Models\Page;

class PageViewComposer
{
    private $model;

    public function __construct(Page $model)
    {
        $this->model = $model;
    }

    public function compose($view)
    {
        $pages = $this->model->whereStatus(1)->where('category_id', 7)->get();
        $servicoes = $this->model->whereStatus(1)->where('category_id', 8)->get();
        return $view->with('pages',  $pages)->with('servicos', $servicoes);
    }
}
