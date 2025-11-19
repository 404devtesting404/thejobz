<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\BusinessSetting;
use App\Model\Contact;
use App\Model\problems;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'mobile_number' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ], [
            'mobile_number.required' => 'Mobile Number is Empty!',
            'subject.required' => ' Subject is Empty!',
            'message.required' => 'Message is Empty!',

        ]);
        $contact = new Contact;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->mobile_number = $request->mobile_number;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->save();

        return response()->json(['success' => 'Your Message Send Successfully']);
    }

    public function list()
    {
        $contacts = Contact::latest()->paginate(25);
        // return view('admin-views.contacts.list', compact('contacts'));
        return view('admin.contacts.list', compact('contacts'));

    }

    public function view($id)
    {
        $contact = Contact::find($id);
        $contact->seen = 1;
        $contact->update();

        $contact = Contact::findOrFail($id);
        return view('admin-views.contacts.view', compact('contact'));
    }

    public function update(Request $request, $id)
    {
        $contact = Contact::find($id);
        $contact->feedback = $request->feedback;
        $contact->seen = 1;
        $contact->update();
        Toastr::success('Feedback Update successfully!');
        return redirect()->route('admin.contact.list');
    }

    public function destroy(Request $request)
    {
        $contact = Contact::find($request->id);
        dd($request->all());
        $contact->delete();

        return response()->json();
    }

    public function send_mail(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        $data = array('body' => $request['mail_body']);
        try {
            Mail::send('email-templates.customer-message', $data, function ($message) use ($contact, $request) {
                $message->to($contact['email'], BusinessSetting::where(['type' => 'company_name'])->first()->value)
                    ->subject($request['subject']);
            });
        } catch (\Exception $exception) {
            // Toastr::error('You have uploaded a wrong format file, please upload the right file.');
            session()->flash('error', 'Eamil not valid.');
            return back();
            // return redirect(route('home'));
        }

        Contact::where(['id' => $id])->update([
            'reply' => json_encode([
                'subject' => $request['subject'],
                'body' => $request['mail_body']
            ])
        ]);

        Toastr::success('Mail sent successfully!');
        return back();
    }

    public function problems_list()
    {
        $problems = problems::latest()->paginate(25);
        return view('admin-views.contacts.problems_list', compact('problems'));
    }


    public function problems_view($id)
    {
        $problem = problems::findOrFail($id);
        return view('admin-views.contacts.problem_view', compact('problem'));
    }

    public function problems_delete(Request $request)
    {
        $contact = problems::find($request->id);
        $contact->delete();

        return response()->json();
    }


}
