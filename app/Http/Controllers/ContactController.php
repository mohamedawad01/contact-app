<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Company;

class ContactController extends Controller
{
    public function index()
    {
        $companies = Company::orderBy('name')->pluck('name', 'id')->prepend('All Companies', '');
        $contacts = Contact::latestFirst()->filter()->paginate(10);
        return view('contacts.index', compact('contacts', 'companies')); 
    }

    public function create()
    {
        $contact = new Contact;
        $companies = Company::orderBy('name')->pluck('name', 'id')->prepend('All Companies', '');
        return view('contacts.create', compact('companies', 'contact'));
    }

    public function store(Request $request)
    {
        // validate the request
        $this->validate($request, [
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'email' => 'required|email|',
            'address' => 'required|min:4',
            // 'phone' => 'required|min:10',
            'company_id' => 'required|exists:companies,id', 
        ]);
        Contact::create($request->all());
        return redirect()->route('contacts.index')->with('message', 'Contact created successfully');
         
    }

    // edit contact 
    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        $companies = Company::orderBy('name')->pluck('name', 'id')->prepend('All Companies', '');
        return view('contacts.edit', compact('companies', 'contact'));

    }

    // update contact
    public function update ($id, Request $request){
                // validate the request
                $this->validate($request, [
                    'first_name' => 'required|min:2',
                    'last_name' => 'required|min:2',
                    'email' => 'required|email|',
                    'address' => 'required|min:4',
                    // 'phone' => 'required|min:10',
                    'company_id' => 'required|exists:companies,id', 
                ]);
                $contact = Contact::findOrFail($id);
                $contact->update($request->all());
                return redirect()->route('contacts.index')->with('message', 'Contact Updated successfully ✔');
    }

    public function show($id)
    {
    $contact = Contact::find($id);
    return view ('contacts.show', compact('contact'));
    }

    // delete contact
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return back()->with('message', 'Contact deleted successfully');
    } 
}


