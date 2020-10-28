<?php


namespace Mubangizi\Layouts;


abstract class Layout
{
    public $show;

    public function __construct($show = false)
    {
        $this->show = $show;
    }
}