<?php namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\User;
use View;

class UserController extends Controller {


    public function index()
    {
        $items = User::paginate();
        return View::make('admin.user.view_user', compact('items'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $user = new User;
        $show = false;
        return View::make('admin.user.new_edit_user', compact('user', 'show'));
    }

        /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {
        $user = new User();
        $user ->name = $request->input('name');
        $user ->profile = $request->input('profile');
        $user ->enable = $request->input('enable');
        $user ->email = $request->input('email');
        $user ->password = \Hash::make($request->input('password'));
        $user->save();
    }

}