<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ElementosXEventalidade
 * 
 * @property int $id_elementEvent
 * @property int $fk_elementInfra
 * @property int $fk_eventualidad
 * 
 * @property ElementosInfraestructura $elementos_infraestructura
 * @property Eventualidade $eventualidade
 *
 * @package App\Models
 */
class ElementosXEventalidade extends Model
{
	protected $table = 'elementos_x_eventalidades';
	protected $primaryKey = 'id_elementEvent';
	public $timestamps = false;

	protected $casts = [
		'fk_elementInfra' => 'int',
		'fk_eventualidad' => 'int'
	];

	protected $fillable = [
		'fk_elementInfra',
		'fk_eventualidad'
	];

	public function elementos_infraestructura()
	{
		return $this->belongsTo(ElementosInfraestructura::class, 'fk_elementInfra');
	}

	public function eventualidade()
	{
		return $this->belongsTo(Eventualidade::class, 'fk_eventualidad');
	}
}
