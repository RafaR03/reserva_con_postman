<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservanolog extends Model
{
    use HasFactory;

    protected $table = "reservasnologs";

    protected $primaryKey = "id";

    protected $fillable = ["name","email","fecha","hora","tarjeta_credito","numero_personas"];
}
