<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Notification;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
class NotificationController extends Controller
{

    public function __construct( Request $request)
    {
        $this->middleware('auth:api');
    }


    public function searchNotification(Request $request)
    {
        try {
            $param = $request->input('key');
            $offset = $request->input('offset');
            $limit = $request->input('limit');
            $notifs = Notification::query();

                if ($param) {
                    $notifs->where(function ($query) use ($param) {
                        $query->where('title', 'like', "%$param%")
                        ->orWhere('message', 'like', "%$param%");
                    });

                }
            $notifs->orderBy('id', 'desc');
            $notifCount = $notifs->count();
            $notifs = $notifs->skip($offset)->take($limit)->get();
            return response()->json(['status' => 'success', 'notifs' => $notifs, 'notifCount' => $notifCount]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $notif = new Notification();
            $notif->createNotification($request->all());
            $response = $this->sendNotification($request);
            return response()->json($response);
        }catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try{
            $notif = new Notification();
            $notif->deleteNotification($id);
            return response()->json(['status' => 'success', 'message' => 'Notification supprimé avec succès']);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updateInfo(Request $request)
    {
        try{
            $notif = new Notification();
            $artist = $notif->updateNotification($request->id, $request->all());
            return response()->json(['status' => 'success', 'message' => 'Notification mis à jour avec succès'],200);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function sendNotification(Request $request)
    {
        $title=$request->title;
        $path=$request->path;
        $message=$request->message;

        $notif = new Notification();
        return $notif->sendNotification($message, $path);
    }
}
