<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        $user = $request->user();
    
        // If the user's email has already been verified, check if they've answered questions.
        if ($user->hasVerifiedEmail()) {
            if (!$user->answered) {
                // Redirect to questions if they haven't.
                return redirect()->route('answer.questions');
            } else {
                // Redirect to HOME with verified=1 if they have.
                return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
            }
        }
    
        // For users whose email isn't verified, mark the email as verified.
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
    
            // After verifying email, check if they've answered questions.
            if (!$user->answered) {
                // Redirect to questions if they haven't.
                return redirect()->route('answer.questions');
            }
        }
    
        // If the email was just verified or if the previous conditions were met, redirect to HOME with verified=1.
        return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
    }
    
}