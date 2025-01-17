<?php

declare(strict_types=1);

use app\constants\AuthUrlsConst;
use app\helpers\Auth;

class HomeController extends FrontBaseController
{

    /**
     * @return void
     */
    public function onConstruct(): void
    {
        parent::onConstruct();
        if (!Auth::check()) {
            $this->response->redirect(AuthUrlsConst::LOGIN)->send();
            exit();
        }
        $this->tag->setTitle('Home page');
    }

    public function indexAction()
    {

    }

}

