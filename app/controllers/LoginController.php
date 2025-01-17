<?php

use app\constants\AuthUrlsConst;
use app\helpers\Auth;
use app\requests\LoginRequest;
use app\services\UserService;
use Phalcon\Http\ResponseInterface;
use Phalcon\Mvc\View;

class LoginController extends FrontBaseController
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
        $this->tag->setTitle('Login page');

        if (Auth::check()) {
            $this->response->redirect(AuthUrlsConst::HOME)->send();
            exit();
        }
        $this->userService = new UserService();
    }

    /**
     * @return ResponseInterface|View|null
     */
    public function loginAction(): View|ResponseInterface|null
    {
        if (!$this->request->isPost()) {
            return $this->view->pick(AuthUrlsConst::LOGIN);
        }

        try {
            $request = (new LoginRequest())->validate();

            if (!$request->isValid) {
                return $this->view->pick(AuthUrlsConst::LOGIN);
            }

            $user = $this->userService->checkUserEmail($request->email);

            if ($user && password_verify($request->password, $user->password)) {
                $this->session->set('auth', (object)['user' => $user]);
                return $this->response->redirect(AuthUrlsConst::HOME);
            }

            $this->flash->error('The username or password is incorrect.');
        } catch (Exception $exception) {
            return $this->exceptionHandler->handleException($exception, AuthUrlsConst::LOGIN);
        }

        return $this->view->pick(AuthUrlsConst::LOGIN);
    }

}