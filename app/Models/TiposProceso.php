<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TiposProceso
 * 
 * @property int $id_tipoProces
 * @property string $nombre_tipoProces
 * 
 * @property Collection|Proceso[] $procesos
 *
 * @package App\Models
 */
class TiposProceso extends Model
{
	protected $table = 'tipos_procesos';
	protected $primaryKey = 'id_tipoProces';
	public $timestamps = false;

	protected $fillable = [
		'nombre_tipoProces'
	];

	public function procesos()
	{
		return $this->hasMany(Proceso::class, 'fk_tipoProces');
	}
}
