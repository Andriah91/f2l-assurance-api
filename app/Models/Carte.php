<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carte extends Model
{
    use SoftDeletes;
	
	protected $fillable = [
        'titre',
        'is_active',
		'path',
        'client_id'
    ];

    
    public function createCarte($data)
    {
        return $this->create($data);
    }

    public function deleteCarte($id)
    {
        $contrat = $this->findOrFail($id);
        $contrat->delete();
        return $contrat;
    }

    public function updateCarte($id, $data)
    {
        $contrat= $this->findOrFail($id);
        $contrat->update($data);
        return $contrat;
    }
}
