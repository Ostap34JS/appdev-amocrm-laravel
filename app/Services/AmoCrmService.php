<?php

namespace App\Services;

use Guzzle;

class AmoCrmService
{
    /**
     * @var array $user
     */
    public $user;

    /**
     * @var array $contacts
     */
    public $contacts = [];

    /**
     * @var array $leads
     */
    public $leads = [];

    /**
     * @var array $companies
     */
    public $companies = [];

    /**
     * @return $this
     */
    public function authorize()
    {
        $request = Guzzle::post('private/api/auth.php?type=json', [
            'body' => json_encode([
                'USER_LOGIN' => config('services.amocrm.email'),
                'USER_HASH' => config('services.amocrm.token')
            ])
        ]);

        $body = json_decode($request->getBody()->getContents());

        $this->user = $body->response->user;

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

    /**
     * @return array
     */
    public function getLeads()
    {
        if (!empty($this->leads)) return $this->leads;

        $request = Guzzle::get('api/v2/leads/');
        $body = json_decode($request->getBody()->getContents());

        if (empty($body)) return [];

        $data = $body->_embedded->items;
        $this->leads = $data;

        return $data;
    }

    /**
     * @return array
     */
    public function getCompanies()
    {
        if (!empty($this->leads)) return $this->leads;

        $request = Guzzle::get('api/v2/companies/');
        $body = json_decode($request->getBody()->getContents());

        if (empty($body)) return [];

        $data = $body->_embedded->items;
        $this->companies = $data;

        return $data;
    }
}