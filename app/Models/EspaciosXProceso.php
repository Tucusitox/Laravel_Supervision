<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EspaciosXProceso
 * 
 * @property int $id_espaProces
 * @property int $fk_espacio
 * @property int $fk_proceso
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Espacio $espacio
 * @property Proceso $proceso
 *
 * @package App\Models
 */
class EspaciosXProceso extends Model
{
	protected $table = 'espacios_x_procesos';
	protected $primaryKey = 'id_espaProces';

	protected $casts = [
		'fk_espacio' => 'int',
		'fk_proceso' => 'int'
	];

	protected $fillable = [
		'fk_espacio',
		'fk_proceso'
	];

	public function espacio()
	{
		return $this->belongsTo(Espacio::class, 'fk_espacio');
	}

	public function proceso()
	{
		return $this->belongsTo(Proceso::class, 'fk_proceso');
	}
}
