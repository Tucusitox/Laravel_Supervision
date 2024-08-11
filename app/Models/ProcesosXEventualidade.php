<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProcesosXEventualidade
 * 
 * @property int $id_procesEvent
 * @property int $fk_proceso
 * @property int $fk_eventualidad
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
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
