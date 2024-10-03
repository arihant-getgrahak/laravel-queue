<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use DB;
use App\Models\ContactUs;
use App\Jobs\SendEmailJob;

class ContactController extends Controller
{
    public function index()
    {
        return view("welcome");
    }

    public function store(ContactRequest $request)
    {
        try {
            $sendData = [
                "name" => $request->name,
                "email" => $request->email,
                "phone" => (int) $request->phone
            ];
            DB::beginTransaction();

            $isCreate = ContactUs::create($sendData);

            DB::commit();

            dispatch(new SendEmailJob($request->all()));
            
            if ($isCreate) {
                return redirect()->back()->with("success", "Your message has been sent successfully.");
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
}
