<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProcesosXEventualidade
 * 
 * @property int $id_procesEvent
 * @property int $fk_proceso
 * @property int $fk_eventualidad
 * 
 * @property Eventualidade $eventualidade
 * @property Proceso $proceso
 *
 * @package App\Models
 */
class ProcesosXEventualidade extends Model
{
	protected $table = 'procesos_x_eventualidades';
	protected $primaryKey = 'id_procesEvent';
	public $timestamps = false;

	protected $casts = [
		'fk_proceso' => 'int',
		'fk_eventualidad' => 'int'
	];

	protected $fillable = [
		'fk_proceso',
		'fk_eventualidad'
	];

	public function eventualidade()
	{
		return $this->belongsTo(Eventualidade::class, 'fk_eventualidad');
	}

	public function proceso()
	{
		return $this->belongsTo(Proceso::class, 'fk_proceso');
	}
}
