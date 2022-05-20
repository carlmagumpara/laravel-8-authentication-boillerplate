<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    public function index()
    {
        return view('common.profile', []);
    }

    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Updated Successfully.',
                'success' => true,
            ], 200);
        }

        return redirect()->back()->withSuccess('Updated Successfully.');
    }

    public function updateProfilePhoto(Request $request)
    {
        $s3 = Storage::disk('s3');
        $fileUrl = $s3->url($s3->put('files/avatar/'.auth()->user()->id, $request->profile_photo, 'public'));
        auth()->user()->update(['photo' => $fileUrl]);

        return redirect()->back()->with('success', 'Successfully updated.');
    }
}
