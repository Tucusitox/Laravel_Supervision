<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TiposEventualidade
 * 
 * @property int $id_tipoEvent
 * @property string $tipo_eventualidad
 * 
 * @property Collection|Eventualidade[] $eventualidades
 *
 * @package App\Models
 */
class TiposEventualidade extends Model
{
	protected $table = 'tipos_eventualidades';
	protected $primaryKey = 'id_tipoEvent';
	public $timestamps = false;

	protected $fillable = [
		'tipo_eventualidad'
	];

	public function eventualidades()
	{
		return $this->hasMany(Eventualidade::class, 'fk_tipoEvent');
	}
}
