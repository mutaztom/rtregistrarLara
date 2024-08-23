<?php

namespace App\Http\Controllers;

use App\Models\Tblregistrant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserAvatarController extends Controller
{
    public function update(Request $request): string
    {
        $path = $request->file('regphoto').storeAs(
            'avatars/'.$request->user()->id, 's3');

        return $path;
    }

    /**
     * Display the specified image.
     *
     * @param  string  $imageName
     * @return \Illuminate\Http\Response
     */
    public function show($imageName)
    {
        // Construct the full path to the image within the storage directory
        $path = storage_path("app/public/{$imageName}");

        // Check if the image exists; if not, return a 404 response
        if ((bool) Storage::exists("public/{$imageName}")) {
            return "File not found at path: {$path}<br>";
        }

        // Return the image as a response
        return $path;
    }

    public function uploadphoto(Request $request)
    {
        //upload photo of registrant
        $regid = Auth()->user()->id;
        if ($request->hasFile('regphoto')) {
            $path = $request->file('regphoto');
            $ext = $path->extension();
            $fname = 'photo_'.$regid.'.'.$ext;
            if (Storage::exists('public/photos/'.$fname)) {
                Storage::delete('public/photos/'.auth()->user()->avatar);
            }
            Storage::putFileAs('public/photos/', $request->file('regphoto'), $fname);
            //$path->storeAs('public/photos/',$fname);
            Auth()->user()->avatar = $fname;
            Auth()->user()->save();
            Tblregistrant::where('id', Auth()->user()->id)
                ->update(['photofile' => $fname]);

            return redirect()->route('profile.edit')->with('success', 'Photo uploaded successfully!');
        } else {
            return redirect()->route('profile.edit')->with('error', 'Please select a photo!');
        }
    }
}
