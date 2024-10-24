<?php

namespace App\Http\Controllers;

use App\Models\Carte;
use App\Models\Notification;
use Illuminate\Http\Request;

use App\Mail\CarteFormMail;
use Illuminate\Support\Facades\Mail;


use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class CartesController extends Controller
{
	
	public function __construct( Request $request)
    {
        $this->middleware('auth:api');
    }

    public function searchCartes(Request $request)
    {
        try {
            $param = $request->input('key');
            $offset = $request->input('offset');
            $limit = $request->input('limit');
            $cartes = Carte::with('user');
            if ($param) {
                $cartes->where(function ($query) use ($param) {
                    $query->where('titre', 'like', "%$param%")
                          ->orWhereHas('user', function ($query) use ($param) {
                              $query->where('first_name', 'like', "%$param%")
                                    ->orWhere('last_name', 'like', "%$param%");
                          });
                });
            }
            $cartes->orderBy('id', 'desc');
            $carteCount = $cartes->count();
            $cartes = $cartes->skip($offset)->take($limit)->get();
            return response()->json(['status' => 'success', 'cartes' => $cartes, 'carteCount' => $carteCount]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $cartes = new Carte();
            $cartes->createCarte($request->all()); 
            return response()->json(['status' => 'success', 'message' => 'Carte créé avec succès']);
        }catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         try {
            $Carte = Carte::orderBy('id', 'desc')->get();
            return response()->json(['status' => 'success', 'data' => $Carte]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updateInfo(Request $request)
    {
        try {
            $carte = Carte::findOrFail($request->id);
            $carte->fill($request->only(['titre','path','is_active']));
            $carte->save();

            return response()->json(['status' => 'success', 'message' => 'Carte mis a jour avec succès', 'carte' => $carte]);
        } catch (\Illuminate\Validation\ValidationException $exception) {
            $firstError = $exception->validator->getMessageBag()->first();
            return response()->json(['error' => $firstError], 422);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
 

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carte  $Carte
     * @return \Illuminate\Http\Response
     */
   
    public function show($id)
    {
        try{
            $carte = Carte::with('user')->findOrFail($id); 
            return response()->json(['status' => 'success', 'carte' => $carte]);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
	
	public function showActive($id)
    {
        $clientID = $id;
        try {
            $carte = Carte::where('is_active', 1)->where('user_id', $clientID)->get();
            return response()->json(['status' => 'success', 'cartes' => $carte]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carte  $Carte
     * @return \Illuminate\Http\Response
     */
    public function edit(Carte $Carte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carte  $Carte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carte $Carte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carte  $Carte
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $cartes = new Carte();
            $cartes->deleteCarte($id);
            return response()->json(['status' => 'success', 'message' => 'La carte est supprimée avec succès']);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function sendNotification(Request $request)
    { 
      
        try { 
        $notif = new Notification();
        $statusOptions = ['désactivée', 'activée']; 
        $title=$request->title;  
        $message=$request->message;  
        $cartes = Carte::findCardByUserId($request->user_id); 
        if($request->id==null) {
            if($cartes->count()>0)
            { 
                $error="Le client possède dejà une carte";
                return response()->json(['error' => $error], 422);
            }
            $userData = $request->get('user');
            $cartes = Carte::findCardByUserId($userData['id']); 
            $cartes = new Carte();
            $cartes->createCarte($request->all()); 

            if($request->is_active==1)
            {  
                $mailToAddress =$userData['email'];  
                $emailData = [
                    'nom' => $userData['first_name'] . ' ' . $userData['last_name'],  
                    'email' => $userData['email'],  
                    'phone' => $userData['phone'] ?? '',   
                    'message' => "Votre carte a ".$request->titre." été " . $statusOptions[$request->is_active],
                    'carte' => $request->titre,
                    'path' => $request->path,
                ];
                Mail::to($mailToAddress)->send(new CarteFormMail($emailData));
                $notif->sendNotification($message, null, $userData['phone'], false);
            }
        }else{ 
            $carte = Carte::findOrFail($request->id);
            $isSending = $carte->is_active; 
            $carte->fill($request->all()); 
            $carte->save();  
            if($isSending!=$request->is_active){  
                $userData = $request->get('user');
                $mailToAddress = $userData['email']; 
                $emailData = [
                    'nom' => $userData['first_name'] . ' ' . $userData['last_name'],  // Utiliser $userData pour nom complet
                    'email' => $userData['email'],  // Utiliser $userData pour email
                    'phone' => $userData['phone'] ?? '',  // Utiliser $userData pour téléphone (si disponible)
                    'message' => "Votre carte ".$request->titre." a été " . $statusOptions[$request->is_active],  // Message de statut
                    'carte' => $request->titre,  // Titre de la carte venant de la requête
                    'path' => $request->path,  // Chemin de l'image ou du fichier venant de la requête
                ];
                Mail::to($mailToAddress)->send(new CarteFormMail($emailData));
                $notif->sendNotification($message, null, $userData['phone'], false);
            }
                
        } 
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
      
    }
   /* public function sendNotification(Request $request)
    {
        try {
        $title=$request->title;  
        $message=$request->message; 

        $carte = Carte::findOrFail($request->id);
        $carte->fill($request->all());

        $carte->save();  
        
        $notif = new Notification();
        return $notif->sendNotification($message, null, $request->user['phone'], false);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }*/
}
