<?php

namespace app\requests;

use Phalcon\Filter\Validation\Validator\PresenceOf;

class LoginRequest extends Request
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
            'email',
            new PresenceOf(
                [
                    'message' => 'The e-mail is required',
                ]
            )
        );

        $this->validation->add(
            'password',
            new PresenceOf(
                [
                    'message' => 'The password is required',
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
