<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Ticket extends Model implements HasMedia
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public $table = 'tickets';

    protected $appends = [
        'adjuntar_archivo',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nombre',
        'correo',
        'id_incidente_id',
        'id_prioridad_id',
        'id_sede_id',
        'comentenos_mas_sobre_su_incidencia',
        'id_estado_id',
        'id_asignado_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function id_incidente()
    {
        return $this->belongsTo(Incidente::class, 'id_incidente_id');
    }

    public function id_prioridad()
    {
        return $this->belongsTo(Prioridad::class, 'id_prioridad_id');
    }

    public function id_sede()
    {
        return $this->belongsTo(Sede::class, 'id_sede_id');
    }

    public function getAdjuntarArchivoAttribute()
    {
        return $this->getMedia('adjuntar_archivo')->last();
    }

    public function id_estado()
    {
        return $this->belongsTo(Estado::class, 'id_estado_id');
    }

    public function id_asignado()
    {
        return $this->belongsTo(Agente::class, 'id_asignado_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
