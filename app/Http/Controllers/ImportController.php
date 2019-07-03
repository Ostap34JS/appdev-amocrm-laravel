<?php

namespace App\Http\Controllers;

use App\Jobs\ImportContacts;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function contacts()
    {
        dispatch(new ImportContacts);

        return redirect()->route('contacts.index');
    }
}
