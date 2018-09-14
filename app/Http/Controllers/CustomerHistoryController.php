<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomerHistory;

class CustomerHistoryController extends Controller
{
    public function show()
    {
        
        return view('customer.pages.customer_history');
    }
}
