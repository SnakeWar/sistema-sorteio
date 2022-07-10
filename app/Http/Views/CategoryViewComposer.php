<?php


namespace App\Http\Views;

use App\Models\Category;

class CategoryViewComposer
{
    private $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function compose($view)
    {
        $categories = $this->model->all();
        return $view->with('categories',  $categories);
    }
}
