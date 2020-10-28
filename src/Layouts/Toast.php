<?php


namespace Mubangizi\Layouts;


class Toast extends Layout
{
    public $title, $body, $status, $icon, $position, $params;

    public function __construct($title = false, $body = false, $show = false, $status = false, $icon = false, $position = false, $params = false)
    {
        $this->icon = $icon;
        $this->body = $body;
        $this->title = $title;
        $this->status = $status;
        $this->params = $params;
        $this->position = $position;
        parent::__construct($show);
    }

}