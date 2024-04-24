<?php

namespace App\Http\Controllers;

use App\Http\Resources\FeatureResource;
use Inertia\Inertia;
use App\Models\Feature; // Assuming Feature model is imported properly
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $features = Feature::where('active', true)->get();
        return Inertia::render('Welcome', [
            'features'=> FeatureResource::collection($features),
            'canLogin' => \Route::has('login'),
            'canRegister' => \Route::has('register'),
        ]);
    }
}
