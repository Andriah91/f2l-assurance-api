<?php
namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Mail\FacturationFormMail;
use App\Mail\SendMail;
use App\Mail\DemoEmail;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;

class SendEmailController extends Controller
{

    public function sendEmail(Request $request)
    {
        $mailToAddress = env('MAIL_FROM_ADDRESS');
        $request->validate([
            'nom' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'message' => 'required|string',
        ]);

        // Envoyez l'email
        $emailData = [
            'nom' => $request->nom,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ];

        Mail::to($mailToAddress)->send(new ContactFormMail($emailData));

        return response()->json(['status' => 'success', 'message' => 'Email envoyé avec succès'], 200);
    }
	
	public function facturation(Request $request)
	{
		$request->validate([
            'path' => 'required',
            'titre' => 'required',
            'user' => 'required',
        ]);
		$user = json_decode($request->user, true);
		$emailData = [
            'path' => $request->path,
            'titre' => $request->titre,
            'user' => $request->user,
			'nom' => $user['first_name'].' '.$user['last_name'],
            'email' => $user['email'],
            'phone' => $user['phone'],
        ];
		
		$mailToAddress = env('MAIL_FROM_ADDRESS');
		
		Mail::to($mailToAddress)->send(new FacturationFormMail($emailData));
		
        return response()->json(['status' => 'success', 'message' => 'Email envoyé avec succès'], 200);
	}
}
