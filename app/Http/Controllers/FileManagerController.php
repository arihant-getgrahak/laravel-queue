<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\FileManager;
use Storage;

class FileManagerController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
    public function store(Request $request)
    {
        try {
            $sendData = [
                "name" => $request->name,
                "email" => $request->email,
                "phone" => (int) $request->phone,
                "image" => $request->file('image') ? $this->uploadImage($request->file('image')) : null,
            ];
            DB::beginTransaction();

            // dd($sendData);

            $isCreate = FileManager::create($sendData);

            DB::commit();

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
        $uploadFolder = 'gallery';
        $image = $file;
        $image_uploaded_path = $image->store($uploadFolder, 'public');
        $uploadedImageUrl = Storage::disk('public')->url($image_uploaded_path);

        return $uploadedImageUrl;
    }
}
