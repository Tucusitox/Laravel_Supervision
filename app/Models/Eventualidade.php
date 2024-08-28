<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Eventualidade
 * 
 * @property int $id_eventualidad
 * @property int $fk_tipoEvent
 * @property int $fk_tipoEstatusEvent
 * @property string $codigo_event
 * @property string $asunto_event
 * @property string $descripcion_event
 * @property Carbon $fecha_inicioEvent
 * @property Carbon|null $fecha_finEvent
 * @property Carbon $fechaCreacion_event
 * 
 * @property TiposEventualidade $tipos_eventualidade
 * @property TiposEstatusevent $tipos_estatusevent
 * @property Collection|ElementosXEventalidade[] $elementos_x_eventalidades
 * @property Collection|Empleado[] $empleados
 * @property Collection|Espacio[] $espacios
 * @property Collection|Proceso[] $procesos
 *
 * @package App\Models
 */
class Eventualidade extends Model
{
	protected $table = 'eventualidades';
	protected $primaryKey = 'id_eventualidad';
	public $timestamps = false;

	protected $casts = [
		'fk_tipoEvent' => 'int',
		'fk_tipoEstatusEvent' => 'int',
		'fecha_inicioEvent' => 'datetime',
		'fecha_finEvent' => 'datetime',
		'fechaCreacion_event' => 'datetime'
	];

	protected $fillable = [
		'fk_tipoEvent',
		'fk_tipoEstatusEvent',
		'codigo_event',
		'asunto_event',
		'descripcion_event',
		'fecha_inicioEvent',
		'fecha_finEvent',
		'fechaCreacion_event'
	];

	public function tipos_eventualidade()
	{
		return $this->belongsTo(TiposEventualidade::class, 'fk_tipoEvent');
	}

	public function tipos_estatusevent()
	{
		return $this->belongsTo(TiposEstatusevent::class, 'fk_tipoEstatusEvent');
	}

	public function elementos_x_eventalidades()
	{
		return $this->hasMany(ElementosXEventalidade::class, 'fk_eventualidad');
	}

	public function empleados()
	{
		return $this->belongsToMany(Empleado::class, 'empleados_x_eventualidades', 'fk_eventualidad', 'fk_empleado')
					->withPivot('id_empleadoEvent');
	}

	public function espacios()
	{
		return $this->belongsToMany(Espacio::class, 'espacios_x_eventualidades', 'fk_eventualidad', 'fk_espacio')
					->withPivot('id_espaEvent');
	}

	public function procesos()
	{
		return $this->belongsToMany(Proceso::class, 'procesos_x_eventualidades', 'fk_eventualidad', 'fk_proceso')
					->withPivot('id_procesEvent');
	}
}
