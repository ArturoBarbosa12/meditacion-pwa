<?php

namespace App\Http\Controllers;

use App\Models\userAffirmations;
use Illuminate\Http\Request;

class UserAffirmationController extends Controller
{
    public function store(Request $request)
    {
        $userAffirmation = new userAffirmations();
        $userAffirmation->user_id = auth()->id();
        $userAffirmation->affirmation_id = $request->affirmation_id;
        $userAffirmation->viewed_at = now();
        $userAffirmation->save();

        // Redirigir al usuario a la afirmación
        return redirect()->route('affirmations.show', $request->affirmation_id);
    }
}
