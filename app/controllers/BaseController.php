<?php

use \Phalcon\Tag;

class BaseController extends \Phalcon\Mvc\Controller
{
    public function initialize()
    {
        $this->tag->prependTitle('Osh li se lodat a ? | ');
    }
}