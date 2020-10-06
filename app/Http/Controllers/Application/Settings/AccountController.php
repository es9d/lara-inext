<?php

namespace App\Http\Controllers\Application\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Application\Settings\Account\Update;
use Illuminate\Support\Facades\Hash;
use App\Models\UserSetting;
class AccountController extends Controller
{
    /**
     * Display Account Settings Page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('application.settings.account.index');
    }

    /**
     * Update the Account of Current Authenticated User
     *
     * @param \App\Http\Requests\Application\Settings\Account\Update $request
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Update $request)
    {
        // If demo mode is active then block this action
        if (config('app.is_demo')) {
            session()->flash('alert-danger', __('messages.action_blocked_in_demo'));
            return redirect()->route('settings.account');
        };

        // Update User
        $user = $request->user();
        $user->update($request->validated());

        // If Password fields are filled
        if ($request->has('old_password')) {
            $user->password = Hash::make($request->new_password);
            $user->save();
        }

        // Upload and save avatar
        if ($request->hasFile('avatar')) {
            $user->clearMediaCollection('avatar');
            $user->addMediaFromRequest('avatar')->toMediaCollection('avatar');
        }
        //set language 
        if($request->has('locale')){
            $user->setSetting('locale',$request->locale);
        }
        session()->flash('alert-success','messages.account_updated');
        return redirect()->route('settings.account');
    }
}
