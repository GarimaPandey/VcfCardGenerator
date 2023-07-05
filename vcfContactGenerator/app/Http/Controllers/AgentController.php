<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Http;


class AgentController extends Controller
{
    function index($fullname){
            $response = Http::get('https://api.canzell.com/__public__/user-service/users?key=id');
    
            $users = $response->json();
    
            foreach ($users as $user) {
                if ($user ['first_name'].$user['last_name'] === $fullname) {
                    return inertia('ContactCard',['user'=>$user]);
                }
            }
    
            return response()->json(['error' => 'User not found'], 404);
    
    }
}
