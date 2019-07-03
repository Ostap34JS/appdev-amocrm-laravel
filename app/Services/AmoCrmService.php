<?php

namespace App\Services;

use Guzzle;

class AmoCrmService
{
    /**
     * @var array $contacts
     */
    public $contacts = [];

    /**
     * @return $this
     */
    public function authorize()
    {
        Guzzle::post('private/api/auth.php?type=json', [
            'body' => json_encode([
                'USER_LOGIN' => config('services.amocrm.email'),
                'USER_HASH' => config('services.amocrm.token')
            ])
        ]);

        return $this;
    }

    /**
     * @return array
     */
    public function getContacts()
    {
        if (!empty($this->contacts)) return $this->contacts;

        $request = Guzzle::get('api/v2/contacts/');
        $body = json_decode($request->getBody()->getContents());

        if (empty($body)) return [];

        $data = $body->_embedded->items;

        $this->contacts = $data;

        return $data;
    }
}