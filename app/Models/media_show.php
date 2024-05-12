<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Spatie\MediaLibrary\HasMedia;
    use Spatie\MediaLibrary\InteractsWithMedia;
    use Spatie\MediaLibrary\MediaCollections\Models\Media;

class media_show extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'id_country',
        'id_media_show_type',
        'id_pemi',
        'nombre',
        'duracion',
        'actores',
        'sinopsis_corta',
        'sinopsis',
        'portada_img',
        'idioma',
        'directores',
        'trailer',
        'fecha_media_show',
        'saga',
        'episodios',
        'temporadas',
    ];

    protected $table = 'media_show';

    public function country()
    {
        return $this->belongsTo(country::class, 'id_country');
    }

    public function mediaShowType()
    {
        return $this->belongsTo(media_show_type::class, 'id_media_show_type');
    }

    public function pemi()
    {
        return $this->belongsTo(pemi::class, 'id_pemi');
    }

    public function genres()
    {
        return $this->belongsToMany(genres::class, 'media_show_genres', 'id_media_show', 'id_genre');
    }
    
    // Define la colección de medios y su conversión
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
            ->useFallbackUrl('/images/placeholder.jpg')
            ->useFallbackPath(public_path('/images/placeholder.jpg'));
    }

    public function registerMediaConversions(Media $media = null): void
    {
        if (env('RESIZE_IMAGE') === true) {
            $this->addMediaConversion('resized-image')
                ->width(env('IMAGE_WIDTH', 300))
                ->height(env('IMAGE_HEIGHT', 300));
        }
    }
}
