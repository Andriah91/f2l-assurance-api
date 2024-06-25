<?php

namespace App\Http\Controllers;

use App\Models\Publicities;
use Illuminate\Http\Request;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class PublicitiesController extends Controller
{
	
	public function __construct( Request $request)
    {
        $this->middleware('auth:api');
    }

    public function searchPub(Request $request)
    {
        try {
            $param = $request->input('key');
            $offset = $request->input('offset');
            $limit = $request->input('limit');
            $pubs = Publicities::query();

                if ($param) {
                    $pubs->where(function ($query) use ($param) {
                        $query->where('titre', 'like', "%$param%"); 
                    });

                }
            $pubs->orderBy('id', 'desc');
            $pubCount = $pubs->count();
            $pubs = $pubs->skip($offset)->take($limit)->get();
            return response()->json(['status' => 'success', 'pubs' => $pubs, 'pubCount' => $pubCount]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $pubs = new Publicities();
            $pubs->createPublicity($request->all()); 
            return response()->json(['status' => 'success', 'message' => 'Publicité créé avec succès']);
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
            $publicities = Publicities::orderBy('id', 'desc')->get();
            return response()->json(['status' => 'success', 'data' => $publicities]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updateInfo(Request $request)
    {
        try {
            $pub = Publicities::findOrFail($request->id);
            $pub->fill($request->only(['titre',
            'link','type','path','is_active'
            ]));
            $pub->save();

            return response()->json(['status' => 'success', 'message' => 'Publicité mis a jour avec succès', 'pub' => $pub]);
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
     * @param  \App\Models\Publicities  $publicities
     * @return \Illuminate\Http\Response
     */
   
    public function show($id)
    {
        try{
            $pub = Publicities::findOrFail($id);
            return response()->json(['status' => 'success', 'pub' => $pub]);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
	
	public function showActive()
    {
        try {
            $pub = Publicities::where('is_active', 1)->get();
            return response()->json(['status' => 'success', 'bannieres' => $pub]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Publicities  $publicities
     * @return \Illuminate\Http\Response
     */
    public function edit(Publicities $publicities)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Publicities  $publicities
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publicities $publicities)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Publicities  $publicities
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $pubs = new Publicities();
            $pubs->deletePublicity($id);
            return response()->json(['status' => 'success', 'message' => 'La publicité est supprimée avec succès']);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
