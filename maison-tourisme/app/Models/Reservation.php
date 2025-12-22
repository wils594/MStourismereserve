<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

    /* =====================
     | CONSTANTES STATUT
     ===================== */
    public const STATUT_EN_ATTENTE = 'en_attente';
    public const STATUT_VALIDEE    = 'validee';
    public const STATUT_REFUSEE    = 'refusee';

    /* =====================
     | ATTRIBUTS MODIFIABLES
     ===================== */
    protected $fillable = [
        'user_id',
        'site_id',
        'nom_complet',
        'pays_origine',
        'langue',
        'date_arrivee',
        'date_depart',
        'nombre_jours',
        'type_groupe',
        'adultes',
        'enfants',
        'total_personnes',
        'statut',
    ];

    /* =====================
     | CASTS
     ===================== */
    protected $casts = [
        'date_arrivee'    => 'date',
        'date_depart'     => 'date',
        'nombre_jours'    => 'integer',
        'adultes'         => 'integer',
        'enfants'         => 'integer',
        'total_personnes' => 'integer',
    ];

    /* =====================
     | RELATIONS
     ===================== */

    /**
     * Utilisateur ayant fait la réservation
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Site touristique réservé
     */
    public function site()
    {
        return $this->belongsTo(Sites::class);
    }
}
