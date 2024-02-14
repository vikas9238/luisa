<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Hash;

class UsersController extends Controller
{

    public function changePassword()
    {
        return view('users.changePassword');
    }

    public function saveChangePassword(Request $request)
    {
        try {
            $message = [
                'old_password.required' => __('The old password field is required.'),
                'new_password.required' => __('The new password field is required.'),
                'new_password.between' => __('The new password must be between 6 and 20 characters.'),
                'confirm_password.required' => __('The confirm password field is required.'),
                'confirm_password.same' => __('The confirm password and new password must match.')
            ];
            $this->validate($request, [
                'old_password' => 'required',
                'new_password' => 'required|between:6,20|different:old_password',
                'confirm_password' => 'required|same:new_password',
                    ], $message);
            $input = $request->all();
            if (!Hash::check($input['old_password'], auth()->user()->password)) {
                return redirect()->back()->withInput()->withErrors(__('Old password does not match with current password'));
            } else {
                $user = User::findOrFail(auth()->user()->id);
                $user->password = Hash::make($input['new_password']);
                $user->update();
                return redirect(route('user.changePassword'))->with('success',__('Password has been changed successfully.'));
            }
        } catch (\Exception $exception) {
            \Log::info($exception->getMessage());
            return redirect()->back()->with('alert-danger', __('Something went wrong. Please try again.'));
        }
    }

}
