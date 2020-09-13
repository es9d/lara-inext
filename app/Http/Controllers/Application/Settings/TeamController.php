<?php

namespace App\Http\Controllers\Application\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Application\Settings\TeamMember\Store;
use App\Http\Requests\Application\Settings\TeamMember\Update;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeamController extends Controller
{
    /**
     * Display Team Settings Page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('application.settings.team.index');
    }

    /**
     * Display the Form for Creating New Team Member
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function createMember(Request $request)
    {
        $member = new User();

        // Fill model with old input
        if (!empty($request->old())) {
            $member->fill($request->old());
        }

        return view('application.settings.team.create_member', [
            'member' => $member,
        ]);
    }

    /**
     * Store the Team Member in Database
     *
     * @param App\Http\Requests\Application\Settings\TeamMember\Store $request
     *
     * @return \Illuminate\Http\Response
     */
    public function storeMember(Store $request)
    {
        $authUser = $request->user();
        $currentCompany = $authUser->currentCompany();

        // If demo mode is active then block this action
        if (config('app.is_demo')) {
            session()->flash('alert-danger', __('messages.action_blocked_in_demo'));
            return redirect()->route('settings.team');
        };

        // Create new Member
        $member = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // Assign Member Role
        $member->assignRole($request->role);

        // Attach Member to Company
        $member->attachCompany($currentCompany);

        // Upload and save avatar
        if ($request->hasFile('avatar')) {
            $member->clearMediaCollection('avatar');
            $member->addMediaFromRequest('avatar')->toMediaCollection();
        }

        session()->flash('alert-success', __('messages.team_member_added'));
        return redirect()->route('settings.team');
    }

    /**
     * Display the Form for Editing Team Member
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function editMember(Request $request)
    {
        $member = User::findByUid($request->member);

        return view('application.settings.team.edit_member', [
            'member' => $member,
        ]);
    }

    /**
     * Update the Team Member
     *
     * @param  App\Http\Requests\Application\Settings\TeamMember\Update  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function updateMember(Update $request)
    {
        $member = User::findByUid($request->member);

        // If demo mode is active then block this action
        if (config('app.is_demo')) {
            session()->flash('alert-danger', __('messages.action_blocked_in_demo'));
            return redirect()->route('settings.team');
        };

        // Update the Member
        $member->update($request->validated());

        // Sync member role
        $member->syncRoles([$request->role]);

        // If Password fields are filled
        if ($request->has('password')) {
            $member->password = Hash::make($request->password);
            $member->save();
        }

        // Upload and save avatar
        if ($request->hasFile('avatar')) {
            $member->clearMediaCollection('avatar');
            $member->addMediaFromRequest('avatar')->toMediaCollection();
        }

        session()->flash('alert-success', __('messages.team_member_updated'));
        return redirect()->route('settings.team');
    }

    /**
     * Delete the Team Member
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteMember(Request $request)
    {
        $member = User::findByUid($request->member);

        // If demo mode is active then block this action
        if (config('app.is_demo')) {
            session()->flash('alert-danger', __('messages.action_blocked_in_demo'));
            return redirect()->route('settings.team');
        };

        // Delete the Member
        $member->delete();

        session()->flash('alert-success', __('messages.team_member_deleted'));
        return redirect()->route('settings.team');
    }
}
