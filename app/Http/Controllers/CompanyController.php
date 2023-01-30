<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Company;
//use App\Models\Sale;

use App\Http\Requests\ManasysRequest;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    //
    public function __construct()
    {
        $this->company = new Company();
    }

}
