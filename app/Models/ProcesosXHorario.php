<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProcesosXHorario
 * 
 * @property int $id_procesoHorario
 * @property int $fk_proceso
 * @property int $fk_horario
 * 
 * @property Horario $horario
 * @property Proceso $proceso
 *
 * @package App\Models
 */
class ProcesosXHorario extends Model
{
	protected $table = 'procesos_x_horarios';
	protected $primaryKey = 'id_procesoHorario';
	public $timestamps = false;

	protected $casts = [
		'fk_proceso' => 'int',
		'fk_horario' => 'int'
	];

	protected $fillable = [
		'fk_proceso',
		'fk_horario'
	];

	public function horario()
	{
		return $this->belongsTo(Horario::class, 'fk_horario');
	}

	public function proceso()
	{
		return $this->belongsTo(Proceso::class, 'fk_proceso');
	}
}
