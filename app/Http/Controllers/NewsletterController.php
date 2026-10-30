<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $existe = NewsletterSubscriber::where('email', $request->email)->first();

        if ($existe) {
            if (!$existe->actif) {
                $existe->update(['actif' => true]);
                return back()->with('newsletter_success', 'Vous êtes de nouveau abonné(e) à notre newsletter !');
            }
            return back()->with('newsletter_success', 'Vous êtes déjà abonné(e) à notre newsletter.');
        }

        NewsletterSubscriber::create([
            'email' => $request->email,
        ]);

        return back()->with('newsletter_success', 'Merci ! Vous êtes maintenant abonné(e) à notre newsletter.');
    }

    public function unsubscribe($token)
    {
        $subscriber = NewsletterSubscriber::where('token_desabonnement', $token)->firstOrFail();
        $subscriber->update(['actif' => false]);

        return view('newsletter.unsubscribed');
    }
}