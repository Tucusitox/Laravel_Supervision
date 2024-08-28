<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TiposElemento
 * 
 * @property int $id_tipoElement
 * @property string $tipo_elemento
 * 
 * @property Collection|ElementosInfraestructura[] $elementos_infraestructuras
 *
 * @package App\Models
 */
class TiposElemento extends Model
{
	protected $table = 'tipos_elementos';
	protected $primaryKey = 'id_tipoElement';
	public $timestamps = false;

	protected $fillable = [
		'tipo_elemento'
	];

	public function elementos_infraestructuras()
	{
		return $this->hasMany(ElementosInfraestructura::class, 'fk_tipoElement');
	}
}
