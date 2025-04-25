<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidature;
use App\Models\Offre;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $offres = Offre::withCount('candidatures')->get();

        $labels = $offres->pluck('title'); // Titres des offres
        $data = $offres->pluck('candidatures_count'); // Nombre de candidatures

        $offre = $offres->first(); // On prend la première offre comme exemple pour l'évolution

        return view('admin.dashboard', compact('labels', 'data', 'offre'));
    }


}
