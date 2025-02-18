<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderProduct;
use App\Mail\ProductForms;

class OrderController extends Controller
{
    public function execute(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string:255',
            'email' => 'required|email',
        ]);

        Mail::to(config('mail.from.address'))->send(new OrderProduct($validated));
        Mail::to($validated['email'])->send(new ProductForms($validated));

        return [
            'success' => true,
        ];
    }
}
