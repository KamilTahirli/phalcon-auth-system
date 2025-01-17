<?php

namespace app\services\handlers;

use app\services\Service;
use Exception;
use Phalcon\Mvc\View;

class ExceptionHandler extends Service
{
    /**
     * @param Exception $exception
     * @param string|null $route
     * @return View|void
     */
    public function handleException(Exception $exception, ?string $route = null)
    {
        $this->log->error($exception->getMessage());
        $this->flash->error('Something went wrong');
        if (!is_null($route)) {
            return $this->view->pick('auth/register');
        }
    }
}