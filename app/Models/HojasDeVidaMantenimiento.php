<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HojasDeVidaMantenimiento extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public const ESTADO_DEL_ACTIVO_RADIO = [
        'activo'   => 'Activo',
        'inactivo' => 'Inactivo',
    ];

    public $table = 'hojas_de_vida_mantenimientos';

    protected $dates = [
        'mantenimiento_preventivo',
        'mantenimiento_correctivo',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'encargado',
        'nombre_del_equipo',
        'modelo',
        'serial',
        'sede_id',
        'observaciones',
        'mantenimiento_preventivo',
        'mantenimiento_correctivo',
        'descripcion_del_mantenimiento',
        'quien_lo_realiza_id',
        'estado_del_activo',
        'created_at',
        'created_by_id',
        'updated_at',
        'deleted_at',
    ];

    public function sede()
    {
        return $this->belongsTo(Sede::class, 'sede_id');
    }

    public function getMantenimientoPreventivoAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setMantenimientoPreventivoAttribute($value)
    {
        $this->attributes['mantenimiento_preventivo'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getMantenimientoCorrectivoAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setMantenimientoCorrectivoAttribute($value)
    {
        $this->attributes['mantenimiento_correctivo'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function quien_lo_realiza()
    {
        return $this->belongsTo(Agente::class, 'quien_lo_realiza_id');
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
