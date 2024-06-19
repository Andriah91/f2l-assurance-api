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

    /**
     * Show the form for creating a new resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
                    'titre' => 'required|string|max:255',
                    'link' => 'required',
                    'path' => 'required',
                    'type' => 'required'
                ], [
                    'titre.required' => 'Le champ titre est obligatoir.',
                    'link.required' => 'Le champ lien est obligatoir.',
                    'path.required' => 'Le champ path est obligatoir.',
                    'type.required' => 'Le champ type deocument est obligatoir.'
                ]);
				
		$user = User::create([
			'titre' => $request->titre,
			'link' => $request->link,
			'path' => $request->path,
			'type' => $request->type,
		]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Publicities  $publicities
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $pub = Publicities::where('id', $id)->get();
            return response()->json(['status' => 'success', 'data' => $pub]);
        } catch (\Exception $e) {
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
            $pub = Publicities::findOrFail($id);
            $pub->delete();
            return response()->json(['status' => 'success', 'message' => 'La publicité est supprimée avec succès']);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
