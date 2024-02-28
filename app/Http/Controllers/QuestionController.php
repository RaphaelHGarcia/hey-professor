<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'question' => ['min:10']
        ]);

        Question::query()->create($attributes);

        return redirect(route('dashboard'));
    }
}
