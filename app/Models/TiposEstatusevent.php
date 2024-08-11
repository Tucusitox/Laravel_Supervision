<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TiposEstatusevent
 * 
 * @property int $id_tipoEstatusEvent
 * @property string $tipo_estatu
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Eventualidade[] $eventualidades
 *
 * @package App\Models
 */
class TiposEstatusevent extends Model
{
	protected $table = 'tipos_estatusevent';
	protected $primaryKey = 'id_tipoEstatusEvent';

	protected $fillable = [
		'tipo_estatu'
	];

	public function eventualidades()
	{
		return $this->hasMany(Eventualidade::class, 'fk_tipoEstatusEvent');
	}
}
