<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Contrat;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;


class DocumentController extends Controller
{

    public function __construct( Request $request)
    {
        $this->middleware('auth:api');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $document = new Document();
            $document->createDocument($request->all());
            return response()->json(['status' => 'success', 'message' => 'Document créé avec succès']);
        }catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function uploadMobile(Request $request)
    {
        try {
            if ($request->hasFile('fichier')) {
                $paths = [];
                $path = "";
                /*dd($request->file('fichier'));*/
/*
                foreach ($request->file('fichier') as $image) {
                    $path = $image->store('public/filaka');
                    $paths[] = $path;
                }
                */
                $image = $request->file('fichier');
                $path = $image->store('filaka', 'public');

                $extension = $image->getClientOriginalExtension();

                return response()->json(['message' => 'success', 'paths' => $paths,'path'=> $path,'ext'=>$extension]);
            } else {
                return response()->json(['error' => 'Aucune image trouvée dans la requête.'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function upload(Request $request)
    {
        try {
            if ($request->hasFile('fichier')) {
                $paths = [];
                foreach ($request->file('fichier') as $image) {
                    $path = $image->store('public/filaka');
                    $paths[] = $path;
                }
                return response()->json(['message' => 'success', 'paths' => $paths]);
            } else {
                return response()->json(['error' => 'Aucune image trouvée dans la requête.'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try{
            $document = new Document();
            $document->deleteDocument($id);
            return response()->json(['status' => 'success', 'message' => 'Contrat supprimé avec succès']);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getByContrat($id)
    {
        try {
            $contrat = Contrat::findOrFail($id);
            $documents = Document::where('contrat_id', $id)->get();
            return response()->json(['status' => 'success', 'documents' => $documents ,'contrat'=>$contrat]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function sendNotification(Request $request)
    { 
        $message=$request->message; 
        
        $document = new Document();
        $document->createDocument($request->all());

        $contrat = Contrat::findOrFail($request->contrat_id);
        $user = User::findOrFail($contrat->user_id);
        $notif = new Notification();
        return $notif->sendNotification($message, null, $user->phone, false);
    }

}
