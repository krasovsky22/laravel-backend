<?php

namespace App\Http\Controllers;

use App\Character;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Characters extends Controller
{
    use UploadTrait;

    public function index()
    {
        $currentUser = Auth::user();

        return new \App\Http\Resources\Characters($currentUser->characters);
    }

    public function show(Character $character)
    {
        $currentUser = Auth::user();
        if ($currentUser->is($character->user)) {
            return new \App\Http\Resources\Character($character);
        }

        return response()->json(['success' => false, 'message' => 'unauthorized'], 400);
    }

    public function updateImage(Request $request)
    {
        $request->validate([
            'character_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('character_image');
        // Make a image name based on user name and current timestamp
        $name = 'test_' . time();
        // Define folder path
        $folder = '/uploads/images';
        // Make a file path where image will be stored [ folder path + file name + file extension]
        $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
        // Upload image
        $this->uploadOne($image, $folder, 's3', $name);

        return response()->json(['success' => true, 'path' => $filePath]);
    }
}
