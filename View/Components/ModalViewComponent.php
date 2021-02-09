<?php

namespace Modules\Dashboard\View\Components;

use Illuminate\View\Component;

class ModalViewComponent extends Component
{


    public $modal_id;
    public $edit_route;
    public $model_id;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($modalId, $editRoute = null, $modelId = null)
    {
        $this->modal_id = $modalId;
        $this->edit_route = $editRoute;
        $this->model_id = $modelId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('dashboard::components.modal_view_component');
    }
}
