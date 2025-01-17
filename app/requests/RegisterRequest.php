<?php

namespace app\requests;

use Phalcon\Filter\Validation\Validator\Email;
use Phalcon\Filter\Validation\Validator\PresenceOf;
use Phalcon\Filter\Validation\Validator\StringLength\Min;
use Phalcon\Filter\Validation\Validator\Uniqueness;
use Users;

class RegisterRequest extends Request
{

    public function __construct()
    {
        parent::__construct();
        $this->rules();
    }

    /**
     * @return void
     */
    private function rules(): void
    {
        $this->validation->add(
            'name',
            new PresenceOf(
                [
                    'message' => 'The name is required',
                ]
            )
        );

        $this->validation->add(
            "name",
            new Min(
                [
                    "min"     => 2,
                    "message" => "The name min 2 characters",
                ]
            )
        );

        $this->validation->add(
            "email",
            new Uniqueness(
                [
                    "model"   => new Users(),
                    "message" => ":field must be unique",
                ]
            )
        );

        $this->validation->add(
            'email',
            new PresenceOf(
                [
                    'message' => 'The e-mail is required',
                ]
            )
        );

        $this->validation->add(
            'email',
            new Email(
                [
                    'message' => 'The e-mail is not valid',
                ]
            )
        );
    }


    /**
     * @return object
     */
    public function validate(): object
    {
        $request = $this->request->getPost();

        $messages = $this->validation->validate($request);

        if (count($messages)) {
            $request['isValid'] = false;
            $this->handleErrors($messages);
            return (object)$request;
        }


        $request['isValid'] = true;
        return (object)$request;
    }

    /**
     * Handles validation errors by flashing messages
     *
     * @param $messages
     * @return void
     */
    private function handleErrors($messages): void
    {
        foreach ($messages as $message) {
            $this->flash->error($message->getMessage());
        }
    }

}