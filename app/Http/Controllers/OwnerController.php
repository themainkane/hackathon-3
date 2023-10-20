<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Owner;

class OwnerController extends Controller
{
    public function index()
    {
        $owners = Owner::query()
            ->orderBy('first_name', 'asc')
            ->paginate(10);

        return view(
            'owners.owners',
            compact(
                'owners'
            )
        );
    }
}
