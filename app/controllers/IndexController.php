<?php

declare(strict_types=1);



class IndexController extends FrontBaseController
{

    public function indexAction()
    {
        $this->tag->setTitle('Home page');
    }

}

