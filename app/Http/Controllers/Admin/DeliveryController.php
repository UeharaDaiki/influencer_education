<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    //
    public function showDeliveryEdit($id) {
        $id = $id;
        return view('user.delivery', compact('id'));
    }
}
