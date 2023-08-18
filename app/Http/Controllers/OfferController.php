<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;

class OfferController extends Controller
{
    


    public $module_view_folder;

    public function __construct()
    {
        $this->module_view_folder = 'front.offers';
    }
    
    public function index()
    {

        $offers = Offer::paginate(10);

        return view($this->module_view_folder . '.index', compact('offers')) ;
    }

}
