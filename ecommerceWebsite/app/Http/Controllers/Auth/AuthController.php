<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // direct login page
    public function loginPage()
    {
        return view('auth.login');
    }

    // direct profile page
    public function profile()
    {
        return view('admin.profile.profile');
    }

    // direct update user information
    public function updateUserInformation(Request $request)
    {
        $this->userValidationCheck($request);
        $userUpdateData = $this->userUpdateData($request);

        User::where('id', Auth::user()->id)
            ->update($userUpdateData);

        return back()
            ->with([
                'updateUserSuccess' => "Your account's profile information is updated."
            ]);
    }

    // direct  update password
    public function updatePassword(Request $request)
    {
        $this->passwordUpdateValidationCheck($request);

        $currentPassword = User::select('password')->where('id', Auth::user()->id)->first()->password;
        $newPassword = Hash::make($request->newPassword);

        if (Hash::check($request->currentPassword, $currentPassword)) {
            User::where('id', Auth::user()->id)->update([
                "password" => $newPassword
            ]);
            return back()
                ->with([
                    'passwordUpdateSuccess' => "Your account's password is updated."
                ]);
        }

        return back()
            ->with([
                'passwordUpdateFail' => "Your current password is not match."
            ]);
    }

    // direct update profile picture
    public function updateProfilePicture(Request $request)
    {
        $this->profileValidationCheck($request);

        if ($request->hasFile('userImage')) {
            $currentImageName = User::select('image_name')->where('id', Auth::user()->id)->first();
            $currentImageName = $currentImageName->image_name;

            $fileName = uniqid() . '_' . $request->file('userImage')->getClientOriginalName();

            $request->file('userImage')->storeAs('public/profileImage', $fileName);

            if (File::exists(public_path() . "/storage/profileImage/" . $currentImageName)) {
                File::delete(public_path() . "/storage/profileImage/" . $currentImageName);
            }

            User::where('id', Auth::user()->id)->update([
                "image_name" => $fileName
            ]);
        }

        return back()
            ->with([
                'profileUpdateSuccess' => "Your account's profile picture is updated."
            ]);
    }

    // direct remove profile photo
    public function removeProfilePicture($userId)
    {
        $currentImageName = User::where('id', $userId)->first()->image_name;

        if (File::exists(public_path() . '/storage/profileImage/' . $currentImageName)) {
            File::delete(public_path() . '/storage/profileImage/' . $currentImageName);
        }

        User::where('id', $userId)->update([
            'image_name' => null,
        ]);

        return back()
            ->with([
                "deletePhotoSuccess" => "Your account's profile picture is deleted."
            ]);
    }

    // direct delete account
    public function deleteAccount()
    {
        User::where('id', Auth::user()->id)->delete();
        Auth::logout();

        return redirect()->route('loginPage');
    }

    // profile validation check
    private function profileValidationCheck($request)
    {
        Validator::make($request->all(), [
            "userImage" => "mimes:jpg,webp,jpeg,png"
        ])->validate();
    }

    // password update validation check
    private function passwordUpdateValidationCheck($request)
    {
        Validator::make($request->all(), [
            'currentPassword' => "required|min:6|max:11",
            'newPassword' => "required|min:6|max:11",
            'confirmPassword' => "required|same:newPassword"
        ])->validate();
    }

    // user validation check
    private function userValidationCheck($request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
        ])->validate();
    }

    // user update data
    private function userUpdateData($request)
    {
        return [
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "address" => $request->address
        ];
    }
}
