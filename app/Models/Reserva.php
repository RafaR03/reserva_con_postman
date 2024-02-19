<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $table = "reservas";

    protected $primaryKey = "id";

    protected $fillable = ["user_id","fecha","hora","tarjeta_credito","numero_personas"];
}
