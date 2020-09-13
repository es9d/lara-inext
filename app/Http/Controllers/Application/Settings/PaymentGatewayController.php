<?php

namespace App\Http\Controllers\Application\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Application\Settings\PaymentGateway\Update;

class PaymentGatewayController extends Controller
{
    /**
     * Display Payment Gateway Settings Page
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        return view('application.settings.payment.gateways.edit', [
            'gateway' => $request->gateway,
        ]);
    }

    /**
     * Update the Gateway Settings
     *
     * @param \App\Http\Requests\Application\Settings\PaymentGateway\Update $request
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Update $request)
    {
        $user = $request->user();
        $currentCompany = $user->currentCompany();

        // If demo mode is active then block this action
        if (config('app.is_demo')) {
            session()->flash('alert-danger', __('messages.action_blocked_in_demo'));
            return redirect()->route('settings.account');
        };

        // Update each settings in database
        foreach ($request->validated() as $key => $value) {
            $currentCompany->setSetting($key, $value);
        }

        session()->flash('alert-success', __('messages.gateway_updated'));
        return redirect()->route('settings.payment.gateway.edit', $request->gateway);
    }
}
