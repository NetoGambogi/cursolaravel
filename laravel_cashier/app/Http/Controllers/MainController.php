<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MainController extends Controller
{
    public function loginPage()
    {
        return view('login');
    }

    public function loginSubmit($id)
    {
        //login direto
        $user = User::findOrFail($id);

        if ($user) {
            auth()->login($user);
            return redirect()->route('plans');
        }
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('login');
    }

    public function plans()
    {
        $prices = [
            "monthly" => Crypt::encryptString(
                config('services.stripe.product_id') . "|" . config('services.stripe.monthly_price')
            ),
            "yearly" => Crypt::encryptString(
                config('services.stripe.product_id') . "|" . config('services.stripe.yearly_price')
            ),
            "longest" => Crypt::encryptString(
                config('services.stripe.product_id') . "|" . config('services.stripe.longest_price')
            ),
        ];

        return view('plans', compact('prices'));
    }

    public function planSelected($id)
    {
        // checa se o id é válido
        $plan = Crypt::decryptString($id);

        if (!$plan) {
            return redirect()->route('plans');
        }

        $plan = explode('|', $plan);
        $product_id = $plan[0];
        $price_id = $plan[1];


        return auth()->user()
            ->newSubscription($product_id, $price_id)
            ->checkout([
                'success_url' => route('subscription.success'),
                'cancel_url' => route('plans'),
            ]);
    }

    public function subscriptionSuccess()
    {
        return view('subscription_success');
    }

    public function dashboard()
    {
        $data = [];

        // checa a data de expiração da inscrição
        $timespamp = auth()->user()->subscription(config('services.stripe.product_id'))
            ->asStripeSubscription()
            ->current_period_end;

        $data['subscription_end'] = date('d/m/Y H:i:s', $timespamp);

        // busca notas fiscias
        $invoices = auth()->user()->invoices();
        $data['invoices'] = $invoices;

        return view('dashboard', $data);
    }

    public function invoiceDownload($id)
    {
        return auth()->user()->downloadInvoice($id);
    }
}
