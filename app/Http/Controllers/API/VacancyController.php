<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RequestVacancy;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class VacancyController extends Controller
{
    public function execute(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string:255',
            'phone' => 'required|regex:/^\+7\s\([0-9]{3}\)\s[0-9]{3}\s[0-9]{2}\s[0-9]{2}$/i',
            'file' => [
                'required',
                'mimes:docx,pdf',
                'max:2048',
            ],
        ]);

        $filename = $validated['file']->getClientOriginalName();
        $folder = 'attachments/' . uniqid();

        $path = Storage::disk('local')->putFileAs($folder, $validated['file'], $filename);

        $data = [
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'attachment' => $path,
        ];

        Mail::to(config('mail.from.address'))->send(new RequestVacancy($data));

        return [
            'success' => true,
        ];
    }
}
