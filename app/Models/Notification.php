<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'path',
        'message'
    ];

    public function createNotification($data)
    {
        return $this->create($data);
    }

    public function deleteNotification($id)
    {
        $notif = $this->findOrFail($id);
        $notif->delete();
        return $notif;
    }

    public function updateNotification($id, $data)
    {
        $notif= $this->findOrFail($id);
        $notif->update($data);
        return $notif;
    }
}



