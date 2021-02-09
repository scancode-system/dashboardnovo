<?php

namespace Modules\Dashboard\Http\ViewComposers\Import;

use Modules\Dashboard\Services\ViewComposer\ServiceComposer;
use Modules\Dashboard\Services\Import\SessionService;

class WidgetComposer extends ServiceComposer 
{

    //private $module;
    //private $method;

    private $import_class;

    private $title;
    private $new;
    private $updated;
    private $failures;
    private $completed;

    public function assign($view)
    {
        $this->init($view);

        $this->title();
        $this->new();
        $this->updated();
        $this->failures();
        $this->completed();
    }


    private function init($view)
    {
        $this->import_class = $view->import_class;

        //$this->module = $view->module;
        //$this->method = $view->method;

        if(isset($view->clear))
        {
            SessionService::clear($this->import_class);
        }
    }

    private function title()
    {
        //dd(SessionService::title($this->import_class));
        $this->title = SessionService::title($this->import_class); //$this->module;
        if(is_null($this->title))
        {
            $this->title = $this->import_class;
        }
    }

    private function new()
    {
        $this->new = SessionService::new($this->import_class);
    }

    private function updated()
    {
        $this->updated = SessionService::updated($this->import_class);
    }

    private function failures()
    {
        $this->failures = SessionService::failures($this->import_class);
    }

    private function completed()
    {
        $this->completed = SessionService::completed($this->import_class);
    }

    public function view($view)
    {
        //$view->with('module', $this->module);
        //$view->with('method', $this->method);
        $view->with('import_class', $this->import_class);
        $view->with('title', $this->title);
        $view->with('new', $this->new);
        $view->with('updated', $this->updated);
        $view->with('failures', $this->failures);
        $view->with('completed', $this->completed);
    }

}