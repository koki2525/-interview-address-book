<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::all();
        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required',
            'number' => 'required'
        ]);
        $contact = new Contact([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'number' => $request->get('number')
        ]);
        $contact->save();
        return redirect('/contacts')->with('success', 'Contact saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = Contact::find($id);
        return view('contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required',
            'number' => 'required'
        ]);
        $contact = Contact::find($id);
        $contact->first_name =  $request->get('first_name');
        $contact->last_name = $request->get('last_name');
        $contact->email = $request->get('email');
        $contact->number = $request->get('number');
        $contact->save();
        return redirect('/contacts')->with('success', 'Contact updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);
        $contact->delete();
        return redirect('/contacts')->with('success', 'Contact deleted!');
    }

    public function search(Request $request)
    {
        $q = $request->get('q');
        $contacts = Contact::where('first_name','LIKE','%'.$q.'%')
                            ->orWhere('last_name','LIKE','%'.$q.'%')
                            ->orWhere('email','LIKE','%'.$q.'%')
                            ->orWhere('number','LIKE','%'.$q.'%')->get();

        if(count($contacts) > 0)
            return view('search-results')->with('contacts',$contacts);
        else return view ('search-results')->with('error','No Contacts found. Try to search again !'); 
    
    }

    public function viewAddEmail($id)
    {
        $contact = Contact::find($id);
        return view('contacts.add-email', compact('contact'));
    }

    public function addEmail(Request $request, $id)
    {
        $contact = Contact::find($id); 
        $email_list = explode(',', $contact->email); 
            
        foreach($email_list as $email_item)
        {
            if($email_item===$request->get('email'))
            {
                return redirect()->back()->with('success', 'This email is already added!');
            }
        }

        $contact->email = $contact->email.','.$request->get('email');
        $contact->save();

        return redirect('contacts')->with('success', 'Email successfully added!');
    }

    public function viewAddNumber($id)
    {
        $contact = Contact::find($id);
        return view('contacts.add-number', compact('contact'));
    }

    public function addNumber(Request $request, $id)
    {
        $contact = Contact::find($id); 
        $number_list = explode(',', $contact->number); 
            
        foreach($number_list as $number_item)
        {
            if($number_item===$request->get('number'))
            {
                return redirect()->back()->with('success', 'This number is already added!');
            }
        }

        $contact->number = $contact->number.','.$request->get('number');
        $contact->save();

        return redirect('contacts')->with('success', 'Number successfully added!');


    }

}
