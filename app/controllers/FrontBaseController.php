<?php

declare(strict_types=1);

use app\services\handlers\ExceptionHandler;
use Phalcon\Mvc\Controller;

class FrontBaseController extends Controller
{
    /**
     * @var ExceptionHandler
     */
    public ExceptionHandler $exceptionHandler;

    /**
     * @return void
     */
    public function onConstruct(): void
    {
        $this->exceptionHandler = new ExceptionHandler();
    }

    /**
     * @return void
     */
    public function initialize(): void
    {
        $this->view->setLayout('front/app');
    }
}

