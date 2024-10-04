<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use DB;
use App\Models\ContactUs;
use App\Jobs\SendEmailJob;
use Storage;

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
                "phone" => (int) $request->phone,
                "image" => $request->file('image') ? $this->uploadImage($request->file('image')) : null,
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

    protected function uploadImage($file)
    {
        $uploadFolder = 'contact-us';
        $image = $file;
        $image_uploaded_path = $image->store($uploadFolder, 'public');
        $uploadedImageUrl = Storage::disk('public')->url($image_uploaded_path);

        return $uploadedImageUrl;
    }
}
