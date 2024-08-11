<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EspaciosXEventualidade
 * 
 * @property int $id_espaEvent
 * @property int $fk_espacio
 * @property int $fk_eventualidad
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Espacio $espacio
 * @property Eventualidade $eventualidade
 *
 * @package App\Models
 */
class EspaciosXEventualidade extends Model
{
	protected $table = 'espacios_x_eventualidades';
	protected $primaryKey = 'id_espaEvent';

	protected $casts = [
		'fk_espacio' => 'int',
		'fk_eventualidad' => 'int'
	];

	protected $fillable = [
		'fk_espacio',
		'fk_eventualidad'
	];

	public function espacio()
	{
		return $this->belongsTo(Espacio::class, 'fk_espacio');
	}

	public function eventualidade()
	{
		return $this->belongsTo(Eventualidade::class, 'fk_eventualidad');
	}
}
