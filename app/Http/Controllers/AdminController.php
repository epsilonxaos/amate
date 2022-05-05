<?php
namespace App\Http\Controllers;

use App\Admin;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminController extends Controller
{
    use AuthenticatesUsers;
    use AuthenticatesUsers {
        logout as doLogout;
    }
    protected $redirectTo = '/cuentas';
    protected $redirectAfterLogout = '/admin';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $info = [
            'title' => 'Administradores',
            'breadcrumb' => [
                [
                    'title' => 'Todos',
                    'route' => 'panel.admins.index',
                    'active' => true
                ]
            ],
            'buttons' => [
                [
                    'title' => 'Agregar Nuevo',
                    'route' => 'panel.admins.create'
                ]
            ]
        ];
        $info['data'] = Admin::all()->sortByDesc('id');
        return view('panel.admins.index', $info);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $info = [
            'title' => 'Administradores',
            'breadcrumb' => [
                [
                    'title' => 'Todos',
                    'route' => 'panel.admins.index',
                ],
                [
                    'title' => 'Nuevo',
                    'route' => 'panel.admins.create',
                    'active' => true
                ]
            ]
        ];
        $info['roles'] = Role::all();
        return view('panel.admins.create', $info);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Sí las constraseñas no son iguales regresamos al paso anterior
        if($request->password != $request->confirm_password){
            return redirect()->back()->withInput($request->input())->withErrors(['invalid' => 'Las contraseñas deben ser iguales']);
        }
        $arr = $request->toArray();
        $arr['password'] = Hash::make($request->password);
        if(Admin::where('email', $arr['email'])->get()->count() > 0){
            return redirect()->back()->withInput($request->input())->withErrors(['invalid' => 'El correo ya está en uso']);
        }else{
            $admin = Admin::create($arr);
            $admin->assignRole($arr['role']);
            return redirect()->route('panel.admins.edit', ['id' => $admin->id]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Int $id)
    {
        $info = [
            'title' => 'Administradores',
            'breadcrumb' => [
                [
                    'title' => 'Todos',
                    'route' => 'panel.admins.index',
                ],
                [
                    'title' => 'Editar',
                    'route' => 'panel.admins.edit',
                    'params' => ['id' => $id],
                    'active' => true
                ]
            ]
        ];
        $info['admin'] = Admin::find($id);
        $info['roles'] = Role::all();
        return view('panel.admins.edit', $info);
    }

    public function editPassword($id){
        $info = [
            'title' => 'Usuarios',
            'breadcrumb' => [
                [
                    'title' => 'Todos',
                    'route' => 'panel.admins.index',
                ],
                [
                    'title' => 'Editar',
                    'route' => 'panel.admins.edit',
                    'params' => ['id' => $id]
                ],
                [
                    'title' => 'Contraseña',
                    'active' => true
                ]
            ],
        ];
        $info['admin'] = Admin::find($id);
        return view('panel.admins.editPassword', $info);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Int $id)
    {
        $arr = $request->toArray();
        //Verificamos que el nuevo correo esté disponible
        if(Admin::where('id', '!=', $id)->where('email', $request->email)->get()->count() > 0){
            return redirect()->back()->withInput($request->input())->withErrors(['invalid' => 'Lo sentimos ese correo ya está en uso']);
        }
        $user = Admin::find($id);
        $user->update($arr);
        //Le asignamos el rol
        $user->assignRole($arr['role']);
        return redirect()->route('panel.admins.edit', ['id' => $id])->with('success', 'Información actualizada');
    }

    public function updatePassword(Request $request, $id){
        $admin = Admin::find($id);
        if($admin){
            if($request->new_password == $request->confirm_password){
                $admin->password = Hash::make($request->new_password);
                $admin->save();
                return redirect()->route('panel.admins.edit', ['id' => $id])->with('success', 'Información actualizada');
            }else{
                return redirect()->back()->withInput($request->input())->withErrors(['invalid' => 'La nueva contraseña no coincide, favor de verificar']);
            }
            /*if(Hash::check($request->password, $admin->password)){*/
            /*}else{
                return redirect()->back()->withInput($request->input())->withErrors(['invalid' => 'Contraseña incorrecta']);
            }*/
        }else{
            return redirect()->back()->withInput($request->input())->withErrors(['invalid' => 'Error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Int $id)
    {
        if(Admin::find($id)){
            Admin::destroy($id);
            return response(['success' => true], 200);
        }else{
            return response(['success' => false], 200);
        }
    }

    public function unauthenticated(){
        return view('panel.admins.login');
    }

    public function login(Request $request){
        //Attempt to log in the seller
        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){
            return redirect()->route('panel.admins.index');
        }else{
            return redirect()->back()->withInput()->withErrors(['message' => 'Correo o contraseña invalida']);
        }
    }

    public function logout(Request $request){
        $this->guard()->logout();
        $request->session()->invalidate();
        return redirect('/admin');
    }
}
