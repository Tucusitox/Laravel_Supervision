<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Genero
 * 
 * @property int $id_genero
 * @property string $nombre_genero
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Persona[] $personas
 *
 * @package App\Models
 */
class Genero extends Model
{
	protected $table = 'generos';
	protected $primaryKey = 'id_genero';

	protected $fillable = [
		'nombre_genero'
	];

	public function personas()
	{
		return $this->hasMany(Persona::class, 'fk_genero');
	}
}
