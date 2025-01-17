<?php

namespace app\helpers;

use Phalcon\Session\Adapter\Stream as SessionAdapter;
use Phalcon\Session\Manager as SessionManager;

class Auth
{
    private static ?SessionManager $sessionInstance = null;

    /**
     * @return bool
     */
    public static function check(): bool
    {
        return self::getSession()->has("auth");
    }


    /**
     * @return mixed
     */
    public static function user(): mixed
    {
        return self::getSession()->get("auth")->user ?? null;
    }

    /**
     * @return SessionManager
     */
    private static function getSession(): SessionManager
    {
        if (self::$sessionInstance === null) {
            self::$sessionInstance = self::createSession();
        }

        return self::$sessionInstance;
    }

    /**
     * @return SessionManager
     */
    private static function createSession(): SessionManager
    {
        $session = new SessionManager();
        $files   = new SessionAdapter([
            'savePath' => sys_get_temp_dir(),
        ]);
        $session->setAdapter($files);
        $session->start();

        return $session;
    }
}