<?php

namespace Mubangizi\Views;

class Page
{

    public $data;
    public $view;
    public $title;

    public function __construct($view = '', $data = [], $title = '')
    {
        $this->view = $view;
        $this->data = $data;
        $this->title = $title;
    }

    public function render(Page $page)
    {
        $this->data = $page->data;
        $this->title = $page->title;
        $this->set_view(
            view($page->view),
            view($page->view, 'views')
        );
        require_once layouts('base', 'includes');
    }

    function crumb($name, $array)
    {
        $this->data['breadcrumbs'][$name] = $array;
    }

    function title($title)
    {
        $this->title = $title;
    }

    function remove_alert()
    {
        $this->data['alert'] = null;
        echo json_encode(array("message" => 'Alert removed'));
    }

    public function set_view($__page, $__view)
    {
        if (file_exists($__page)) {
            $this->view = $__page;
        } elseif (file_exists($__view)) {
            $this->view = $__view;
        } else {
            $this->view = view('server-error');
        }
    }
}
