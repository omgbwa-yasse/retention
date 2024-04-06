<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MissionAction extends Model
{
    /**
     * Effectue l'action d'édition.
     *
     * @return \Illuminate\Http\Response
     */
    public static function edit()
    {
        // Implémentez la logique pour l'action d'édition ici
        return view('add.mission.index');
    }

    /**
     * Effectue l'action de suppression.
     *
     * @return \Illuminate\Http\Response
     */
    public static function delete()
    {
        // Implémentez la logique pour l'action de suppression ici
        return view('add.mission.index');
    }

    /**
     * Effectue l'action de stockage (création).
     *
     * @return \Illuminate\Http\Response
     */
    public static function store()
    {
        // Implémentez la logique pour l'action de stockage ici
        return view('add.mission.index');
    }

    /**
     * Effectue l'action de mise à jour.
     *
     * @return \Illuminate\Http\Response
     */
    public static function update()
    {
        // Implémentez la logique pour l'action de mise à jour ici
        return view('add.mission.index');
    }
}
