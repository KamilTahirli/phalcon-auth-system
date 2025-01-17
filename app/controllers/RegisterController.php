<?php

declare(strict_types=1);

use app\constants\AuthUrlsConst;
use app\helpers\Auth;
use app\requests\RegisterRequest;
use app\services\UserService;
use Phalcon\Http\ResponseInterface;
use Phalcon\Mvc\View;

class RegisterController extends FrontBaseController
{
    /**
     * @var UserService
     */
    private UserService $userService;

    /**
     * @return void
     */
    public function onConstruct(): void
    {
        parent::onConstruct();
        $this->tag->setTitle('Register page');

        if (Auth::check()) {
            $this->response->redirect(AuthUrlsConst::HOME)->send();
            exit();
        }
        $this->userService = new UserService();
    }

    /**
     * @return ResponseInterface|View|null
     */
    public function registerAction(): View|ResponseInterface|null
    {
        if (!$this->request->isPost()) {
            return $this->view->pick(AuthUrlsConst::REGISTER);
        }

        try {
            $request = (new RegisterRequest())->validate();

            if (!$request->isValid) {
                return $this->view->pick(AuthUrlsConst::REGISTER);
            }

            $user = $this->userService->createUser($request);

            $this->session->set('auth', (object)['user' => $user]);
            return $this->response->redirect(AuthUrlsConst::HOME);
        } catch (Exception $exception) {
            return $this->exceptionHandler->handleException($exception, AuthUrlsConst::REGISTER);
        }
    }
}

