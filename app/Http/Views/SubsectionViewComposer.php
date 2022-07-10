<?php


namespace App\Http\Views;

use App\Models\Subsection;

class SubsectionViewComposer
{
    private $model;

    public function __construct(Subsection $model)
    {
        $this->model = $model;
    }

    public function compose($view)
    {
        $subsections = Subsection::whereStatus(1)
            ->get();
        return $view->with('subsections',  $subsections);
    }
}
