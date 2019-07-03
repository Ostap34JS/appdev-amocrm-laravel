<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Requests\StoreContact;
use App\Jobs\CreateContact;
use App\Services\AmoCrmService;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function __construct(AmoCrmService $amoCrmService)
    {
        $this->amoCrmService = $amoCrmService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contacts.index', [
            'contacts' => Contact::latest('id')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.create', [
            'leads' => $this->amoCrmService->authorize()->getLeads(),
            'companies' => $this->amoCrmService->authorize()->getCompanies()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreContact  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContact $request)
    {
        dispatch(new CreateContact($request->all()));

        Session::flash('message', "A new contact added to AmoCRM successful!");
        return redirect()->route('contacts.index');
    }
}
