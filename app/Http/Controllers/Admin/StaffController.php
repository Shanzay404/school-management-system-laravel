<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Spatie\Permission\Middleware\PermissionMiddleware;

class StaffController extends Controller
{
    public static function middleware(): array
    {
        return [
            new Middleware(PermissionMiddleware::class . ':view staff', only: ['view', 'show']),
        ];
    }
    public function view(){
        $page_heading="View Staff";
        $staffMembers=User::where('role','!=','student')->get();
        // $staffMembers=User::get();
        return view('Admin.Pages.Staff.view',compact('page_heading','staffMembers'));
    }

    public function show($id){
        $page_heading="View Staff";
        $member=User::find($id);
        return view('Admin.Pages.Staff.staff-detail',compact('page_heading','member'));
    }
}
