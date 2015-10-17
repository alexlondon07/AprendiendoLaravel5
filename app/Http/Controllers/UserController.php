<?php namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use View;
use App\User;

class UserController extends Controller {


    public function index()
    {
        $items = User::paginate();
        //dd($items);
        $items->setPath('user');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $user = User::find($id);
        $show = false;
        return View::make('admin.user.new_edit_user', compact('user', 'show'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $user = User::find($id);
        $show = true;
        return View::make('admin.user.new_edit_user', compact('user', 'show'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $user = User::find($id);
        $user->delete();
        return Redirect::to('admin/user')->with('success_message', 'El registro ha sido borrado correctamente.')->withInput();
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
        return Redirect::to('admin/user')->with('success_message', 'Registro guardado correctamente!');
    }


    /**
     * Metodo para hacer la busqueda
     */
    public static function search(Request $request) {
        $items = array();
        $search = '';
        if ($request->input('search')) {
            $search = $request->input('search');
            $arrparam = explode(' ', $search);
            $items = User::whereNested(function($q) use ($arrparam) {
                $p = $arrparam[0];
                $q->whereNested(function($q) use ($p) {
                    $q->where('id', 'LIKE', '%' . $p . '%');
                    $q->orwhere('name', 'LIKE', '%' . $p . '%');
                    $q->orwhere('email', 'LIKE', '%' . $p . '%');
                    $q->orwhere('enable', 'LIKE', '%' . $p . '%');
                });
                $c = count($arrparam);
                if ($c > 1) {
                    foreach ($arrparam as $p) {
                        $p = $arrparam[$i];
                        $q->whereNested(function($q) use ($p) {
                            $q->where('id', 'LIKE', '%' . $p . '%');
                            $q->orwhere('name', 'LIKE', '%' . $p . '%');
                            $q->orwhere('email', 'LIKE', '%' . $p . '%');
                            $q->orwhere('enable', 'LIKE', '%' . $p . '%');
                        }, 'OR');
                    }
                }
            })
            //->whereNull('deleted_at')
            ->orderBy('name', 'ASC')
            ->paginate(10);
            return View::make('admin.user.view_user', compact('items', 'search'));
        }
    }

}