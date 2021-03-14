<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function __construct()
    {
        $this->title = 'User';
        $this->breadcrumb = [
            'Home',
            'Config',
            'User',
        ];
        $this->route = 'user.';
        $this->view = 'user.';
        $this->datatablesStructure = [
            'default_order_on_collumn' => 4,
            'collumns' => [
                [
                    'name' => 'id',
                    'data' => 'id',
                    'label' => 'ID',
                    'width' => '10px',
                    'className' => 'text-center',
                    'orderable' => true
                ],
                [
                    'name' => 'avatar',
                    'data' => 'avatar',
                    'label' => '',
                    'width' => '50px',
                    'className' => 'text-center',
                    'orderable' => false,
                    'serachable' => false
                ],
                [
                    'name' => 'name',
                    'data' => 'name',
                    'label' => 'Name',
                    'width' => '150px',
                    'className' => '',
                    'orderable' => true
                ],
                [
                    'name' => 'email',
                    'data' => 'email',
                    'label' => 'Email',
                    'width' => '100px',
                    'className' => '',
                    'orderable' => true
                ],
                [
                    'name' => 'roles',
                    'data' => 'roles',
                    'label' => 'Roles',
                    'width' => '70px',
                    'className' => '',
                    'orderable' => false,
                    'searchable' => false
                ],
                [
                    'name' => 'updated_at',
                    'data' => 'updated_at',
                    'label' => 'Last Activity',
                    'className' => '',
                    'orderable' => true,
                    'searchable' => false
                ],
                [
                    'name' => 'actions',
                    'data' => 'actions',
                    'label' => '',
                    'width' => '15px',
                    'orderable' => false,
                    'searchable' => false,
                    'className' => 'text-center'
                ]
            ]
        ];
    }

    public function index()
    {
        return $this->render('index');
    }

    public function create()
    {
        $this->title = 'Create User';
        $this->breadcrumb = [
            'Home',
            'Config',
            'User Management',
            'User',
            'Create'
        ];

        return $this->render('create', [
            'roles' => Role::all()
        ]);
    }

    public function store(UserRequest $request)
    {
        User::createData($request);

        return redirect()->route($this->route . 'index')
            ->with('status', 'success')
            ->with('message', 'Success Create User');
    }

    public function show($id)
    {
        return view('config::show');
    }

    public function edit(User $user)
    {
        $this->title = 'Edit User';
        $this->breadcrumb = [
            'Home',
            'Config',
            'User Management',
            'User',
            'Edit'
        ];

        return $this->render('edit', [
            'user' => $user,
            'roles' => Role::all()
        ]);
    }

    public function update(User $user, UserRequest $request)
    {
        User::updateData($user, $request);

        return redirect()->route($this->route . 'index')
            ->with('status', 'success')
            ->with('message', 'Success Update User');
    }

    public function destroy(User $user)
    {

        User::deleteData($user);

        return redirect()->route($this->route . 'index')
            ->with('status', 'success')
            ->with('message', 'Success Delete User');
    }

    public function datatablesStructure()
    {
        return response()->json([
            'datatables_url' => route($this->route . 'datatables'),
            'table_options' => $this->datatablesOptions,
            'table_structure' => $this->datatablesStructure
        ]);
    }

    public function datatables()
    {
        $users = User::datatables();

        return DataTables::of($users)
            ->editColumn('avatar', function ($user) {
                return $this->makeImageForDatatables($user->avatar);
            })
            ->addColumn('roles', function ($user) {
                $roles = '';
                foreach ($user->getRoleNames() as $role) {
                    $roles .= '<span class="badge badge-pill badge-secondary">' . $role . '</span> ';
                }

                return $roles;
            })
            ->editColumn('updated_at', function ($user) {
                return $this->makeLastActivity($user);
            })
            ->addColumn('actions', function ($user) {
                $actions[] = (object) [
                    'type' => 'link',
                    'name' => 'edit',
                    'label' => 'Edit',
                    'icon' => 'fas fa-edit',
                    'url' => route($this->route . 'edit', $user->id),
                    'tooltip' => ''
                ];

                $actions[] = (object) [
                    'type' => 'button',
                    'name' => 'delete',
                    'label' => 'Delete',
                    'icon' => 'fas fa-trash',
                    'url' => route($this->route . 'destroy', $user->id),
                    'onclick' => 'window.deleteComfirmation(this)',
                    'tooltip' => ''
                ];

                return $this->makeActionButtons($actions);
            })
            ->rawColumns(['actions', 'roles', 'avatar', 'updated_at'])
            ->make(true);
    }
}
