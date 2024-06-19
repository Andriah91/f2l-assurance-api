<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publicities extends Model
{
    use SoftDeletes;
	
	protected $fillable = [
        'title',
        'link',
        'is_active',
		'path',
		'type'
    ];

    public function createPublicity($data)
    {
        return $this->create($data);
    }

    public function deletePublicity($id)
    {
        $contrat = $this->findOrFail($id);
        $contrat->delete();
        return $contrat;
    }

    public function updatePublicity($id, $data)
    {
        $contrat= $this->findOrFail($id);
        $contrat->update($data);
        return $contrat;
    }
}
