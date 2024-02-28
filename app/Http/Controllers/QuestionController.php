<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function store(Request $request)
    {

        Question::query()->create([
           'question' => $request->question
        ]);

        return redirect(route('dashboard'));
    }
}
