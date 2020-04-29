<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Categories;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function allCategories() {
        $mainCategories = Categories::with('subCategories')->where(['parent_id'=>0])->get();
        // echo "<pre>"; print_r($mainCategories); die;
        return $mainCategories;
    }
}
