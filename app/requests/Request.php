<?php

namespace app\requests;

use Phalcon\Di\Injectable;
use Phalcon\Filter\Validation;

class Request extends Injectable
{

    /**
     * @param Validation $validation
     */
    public function __construct(
        protected Validation $validation = new Validation()
    ) {
    }
}