<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TiposEmp
 * 
 * @property int $id_tipo_emp
 * @property string $tipo_empleado
 * 
 * @property Collection|Empleado[] $empleados
 *
 * @package App\Models
 */
class TiposEmp extends Model
{
	protected $table = 'tipos_emps';
	protected $primaryKey = 'id_tipo_emp';
	public $timestamps = false;

	protected $fillable = [
		'tipo_empleado'
	];

	public function empleados()
	{
		return $this->hasMany(Empleado::class, 'fk_tipo_emp');
	}
}
