<?php

namespace app\services;

use app\constants\RoleConst;
use Exception;
use Phalcon\Mvc\Model\ResultInterface;
use Phalcon\Mvc\ModelInterface;
use Users;

class UserService
{
    /**
     * @param $userData
     * @return Users
     * @throws Exception
     */
    public function createUser($userData): Users
    {
        try {
            $user             = new Users();
            $user->name       = $userData->name;
            $user->email      = $userData->email;
            $user->password   = password_hash($userData->password, PASSWORD_DEFAULT);
            $user->role_id    = RoleConst::USER;
            $user->token      = md5(uniqid() . time());
            $user->created_at = date('Y-m-d H:i:s');
            $user->save();

            if (!$user->save()) {
                throw new Exception(json_encode($user->getMessages()));
            }
            return $user;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param string $email
     * @return ResultInterface|ModelInterface|Users|null
     */
    public function checkUserEmail(string $email): ResultInterface|Users|ModelInterface|null
    {
        return Users::findFirst(
            [
                'conditions' => 'email = :email:',
                'bind'       => [
                    'email' => $email
                ]
            ]
        );
    }
}