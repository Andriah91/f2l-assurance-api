<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Twilio\Rest\Client;

class AuthController extends Controller
{


    public function registerClient(Request $request)
    {
        try {
            $phonePrefix = env('PHONE_PREFIX');
            $phoneNumber =$phonePrefix . $request->phone ;

            $validatedData = $request->validate([
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|unique:users,phone',
                'registration_number' => 'required|unique:users,registration_number',
                'first_name' => 'required',
                'last_name' => 'required'
            ],[
                'email.required' => 'Le champ email est requis.',
                'email.email' => 'L\'email doit être une adresse email valide.',
                'email.unique' => 'L\'adresse email est déjà utilisée.',
                'registration_number.unique' => 'Numéro d\'enregistrement est déjà utilisée.',
                'phone.unique' => 'Le numéro de téléphone est déjà utilisé.',
                'first_name.required' => 'Le champ prénom est requis.',
                'first_name.min' => 'Le nom doit contenir au moins :min caractères.',
                'last_name.required' => 'Le champ nom est requis.',
                'last_name.min' => 'Le prénom doit avoir au moins :min caractères.'
            ]);


            $user  = [
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'registration_number' => $validatedData['registration_number'],
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
            ];
/*
            $twilioSid = getenv("TWILIO_SID");
            $twilioToken = getenv("TWILIO_AUTH_TOKEN");
            $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
            $twilio = new Client($twilioSid, $twilioToken);

            $verification = $twilio->verify->v2->services($twilio_verify_sid)
                ->verifications
                ->create($phoneNumber, "sms");*/

            return response()->json([
                'status' => 'success',
                'message' => 'Envoi code otp pour inscription',
                'user' => $user
            ]);

        } catch (\Illuminate\Validation\ValidationException $exception) {
            $firstError = $exception->validator->getMessageBag()->first();
            return response()->json(['error' => $firstError], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function registerClientBO(Request $request)
    {
        try {
            $phoneNumber = $request->phone;

            $request->validate([
                'email' => 'required|string|email|max:255|unique:users',
                'phone' => 'required|string|unique:users',
                'first_name' => 'required|string|min:3',
                'last_name' => 'required|string|max:255'
            ], [
                'email.required' => 'Le champ email est requis.',
                'email.email' => 'L\'email doit être une adresse email valide.',
                'email.unique' => 'L\'adresse email est déjà utilisée.',
                'phone.unique' => 'Le numéro de téléphone est déjà utilisé.',
                'first_name.required' => 'Le champ prénom est requis.',
                'first_name.min' => 'Le nom doit contenir au moins :min caractères.',
                'last_name.required' => 'Le champ nom est requis.',
                'last_name.min' => 'Le prénom doit avoir au moins :min caractères.'
            ]);

            $user  = [
                'email' => $request->email,
                'phone' => $request->phone,
                'registration_number' =>  $request->registration_number,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
            ];

            $user = User::create([
                'is_admin' => 0,
                'email' => $request->email,
                'password' => Hash::make("client"),
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'registration_number' => $request->registration_number,
                'phone' => $request->phone,
                'is_valid' => 0
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully',
                'user' => $user
            ]);

        } catch (\Illuminate\Validation\ValidationException $exception) {
            $firstError = $exception->validator->getMessageBag()->first();
            return response()->json(['error' => $firstError], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function validateRegister(Request $request)
    {
        try {
            $phonePrefix = env('PHONE_PREFIX');
            $phoneNumber =$phonePrefix . $request->phone ;
            /*$otp = $request->opt_code;

            $twilioSid = getenv("TWILIO_SID");
            $twilioToken = getenv("TWILIO_AUTH_TOKEN");
            $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
            $twilio = new Client($twilioSid, $twilioToken);

                $verificationCheck = $twilio->verify->v2->services($twilio_verify_sid)
                    ->verificationChecks
                    ->create([
                        'code' => $otp,
                        'to' => $phoneNumber
                    ]);

                if (!$verificationCheck->valid) {
                    Auth::logout();
                    return response()->json([
                        'status' => 'error',
                        'message' => "LE CODE EST INVALIDE"
                    ],200);
                }*/

            $user = User::create([
                'is_admin' => 0,
                'email' => $request->email,
                'password' => Hash::make("client"),
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'registration_number' => $request->registration_number,
                'phone' => $request->phone,
                'is_valid' => 1
            ]);

            $token = Auth::login($user);

            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully',
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);

        } catch (\Illuminate\Validation\ValidationException $exception) {
            $firstError = $exception->validator->getMessageBag()->first();
            return response()->json(['error' => $firstError], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function loginClient(Request $request)
    {

   
    try {
        $credentials = $request->only('registration_number','phone');
        $credentials['password']="client";
        $phonePrefix = env('PHONE_PREFIX');
        $phoneNumber =$phonePrefix . $request->phone;

        $token = Auth::attempt($credentials);

        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Numéro de téléphone ou enregistrement invalide',
            ], 401);
        }

        $user = Auth::user();
        if (!$user || !$user->is_valid) {
            return response()->json([
                'status' => 'error',
                'message' => 'Numéro de téléphone ou enregistrement invalide*',
            ], 401);
        }


       /* $twilioSid = getenv("TWILIO_SID");
        $twilioToken = getenv("TWILIO_AUTH_TOKEN");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        $twilio = new Client($twilioSid, $twilioToken);

        $verification = $twilio->verify->v2->services($twilio_verify_sid)
            ->verifications
            ->create($phoneNumber, "sms");*/
         
            return response()->json([
                'status' => 'SUCCESS',
                'users' => $user,
            ], 200);


    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

public function validateLogin(Request $request)
{
    try {
    $otp = $request->opt_code;
    $phonePrefix = env('PHONE_PREFIX');
    $phoneNumber =$phonePrefix . $request->phone;
    $credentials = $request->only('registration_number', 'phone');
    $credentials['password']="client";
    $token = Auth::attempt($credentials);

    /*$twilioSid = getenv("TWILIO_SID");
    $twilioToken = getenv("TWILIO_AUTH_TOKEN");
    $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
    $twilio = new Client($twilioSid, $twilioToken);

        $verificationCheck = $twilio->verify->v2->services($twilio_verify_sid)
            ->verificationChecks
            ->create([
                'code' => $otp,
                'to' => $phoneNumber
            ]);

        if (!$verificationCheck->valid) {
            Auth::logout();
            return response()->json([
                'status' => 'error',
                'message' => "LE CODE EST INVALIDE"
            ],200);
        }*/
        $user = Auth::user();
        $data= [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'is_admin' => $user->is_admin,
        ];
        $generateToken = Auth::claims($data)->attempt($credentials);
        return response()->json([
                'status' => 'success',
                'user' => $user,
                'authorisation' => [
                    'token' => $generateToken,
                    'type' => 'bearer',
                ]
            ]);

    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


    public function checkToken(Request $request)
    {
        $token = $request->bearerToken();
        if ($token) {
            return response()->json(['token' => $token]);
        } else {
            return response()->json(['message' => 'Aucun jeton n\'est présent dans la requête.'], 401);
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $phoneNumber=$request->password;
        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Mot de passe ou email invalide',
            ], 401);
        }

        $user = Auth::user();
        if (!$user || !$user->is_admin) {
            return response()->json([
                'status' => 'error',
                'message' => 'Mot de passe ou email invalide',
            ], 401);
        }
        $data= [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'is_admin' => $user->is_admin,
        ];
        $generateToken = Auth::claims($data)->attempt($credentials);
        return response()->json([
                'status' => 'success',
                'user' => $user,
                'authorisation' => [
                    'token' => $generateToken,
                    'type' => 'bearer',
                ]
            ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
       // try {

                $request->validate([
                    'email' => 'required|string|email|max:255|unique:users',
                    'password' => 'required|string|min:6',
                    'first_name' => 'required|string|min:3',
                    'last_name' => 'required|string|max:255'
                ], [
                    'email.required' => 'Le champ email est requis.',
                    'email.email' => 'L\'email doit être une adresse email valide.',
                    'email.unique' => 'L\'adresse email est déjà utilisée.',
                    'password.required' => 'Le champ mot de passe est requis.',
                    'password.min' => 'Le mot de passe doit avoir au moins :min caractères.',
                    'first_name.required' => 'Le champ prénom est requis.',
                    'first_name.min' => 'Le nom doit contenir au moins :min caractères.',
                    'last_name.required' => 'Le champ nom est requis.',
                    'last_name.min' => 'Le prénom doit avoir au moins :min caractères.'
                ]);

            $user = User::create([
                'is_admin' => 1,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'is_valid' =>1
            ]);

            $token = Auth::login($user);

            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully',
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);

        // } catch (\Illuminate\Validation\ValidationException $exception) {
        //     $firstError = $exception->validator->getMessageBag()->first();
        //     return response()->json(['error' => $firstError], 422);
        // } catch (\Exception $e) {
        //     return response()->json(['error' => $e->getMessage()], 500);
        // }
    }


    public function logout()
    {
        try{
            Auth::logout();
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully logged out',
            ]);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    public function refresh()
    {
        try{
            return response()->json([
                'status' => 'success',
                'user' => Auth::user(),
                'authorisation' => [
                    'token' => Auth::refresh(),
                    'type' => 'bearer',
                ]
            ]);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
