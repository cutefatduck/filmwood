<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class p_genres extends Model
{
    use HasFactory;

    protected $table = 'p_genres';

    protected $fillable = [
        'name_genre'
    ];

    public function mediaShows()
    {
        return $this->belongsToMany(p_media_show::class, 'p_media_show_genre', 'id_genre', 'id_media_show');
    }
}
