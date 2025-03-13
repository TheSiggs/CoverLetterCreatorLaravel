<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CoverLetterController extends Controller
{
    public function index()
    {
        return view('coverletter');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'website' => 'required|url',
        ]);
        $data = $request->all();
        $website = $data["website"];
        $name = $data["name"];
        $summary = $data["summary"];
        $skills = $data["skills"];
        $experience = $data["experience"];
        $resume = "# My Name: $name\n\n## Summary\n\n$summary\n\n## Experience\n\n$experience\n\n## Skills\n\n$skills";

        $data = [
            'url' => $website,
            'resume' => $resume,
        ];

        $response = Http::asForm()->timeout(600)->post(config('app.api_url') . '/submit', $data);
        Log::info($response->status());
        Log::info($response->body());
        $coverletter = $response->body();

        return view('coverletterresult', compact('coverletter'));
    }
}
