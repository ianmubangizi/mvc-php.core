<?php


namespace Mubangizi\Layouts;


class Alert extends Layout
{
    public $icon, $status, $title, $text;

    public function __construct($title = false, $text = false, $show = false, $icon = false, $status = false)
    {
        $this->icon = $icon;
        $this->text = $text;
        $this->title = $title;
        $this->status = $status;
        parent::__construct($show);
    }
}