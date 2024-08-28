<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ElementosInfraestructura
 * 
 * @property int $id_elementInfra
 * @property int $fk_tipoElement
 * @property int $fk_espacio
 * @property string $descripcion_element
 * 
 * @property Espacio $espacio
 * @property TiposElemento $tipos_elemento
 * @property Collection|ElementosXEvaluacione[] $elementos_x_evaluaciones
 * @property Collection|ElementosXEventalidade[] $elementos_x_eventalidades
 *
 * @package App\Models
 */
class ElementosInfraestructura extends Model
{
	protected $table = 'elementos_infraestructuras';
	protected $primaryKey = 'id_elementInfra';
	public $timestamps = false;

	protected $casts = [
		'fk_tipoElement' => 'int',
		'fk_espacio' => 'int'
	];

	protected $fillable = [
		'fk_tipoElement',
		'fk_espacio',
		'descripcion_element'
	];

	public function espacio()
	{
		return $this->belongsTo(Espacio::class, 'fk_espacio');
	}

	public function tipos_elemento()
	{
		return $this->belongsTo(TiposElemento::class, 'fk_tipoElement');
	}

	public function elementos_x_evaluaciones()
	{
		return $this->hasMany(ElementosXEvaluacione::class, 'fk_elementInfra');
	}

	public function elementos_x_eventalidades()
	{
		return $this->hasMany(ElementosXEventalidade::class, 'fk_elementInfra');
	}
}
