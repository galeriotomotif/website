<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Post\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->title = 'Category';
        $this->breadcrumb = [
            'Home',
            'Category',
        ];
        $this->route = 'category.';
        $this->view = 'category.';
        $this->datatablesStructure = [
            'default_order_on_collumn' => 0,
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
                    'name' => 'image',
                    'data' => 'image',
                    'label' => '',
                    'width' => '80px',
                    'className' => 'text-center',
                    'orderable' => false,
                    'serachable' => false
                ],
                [
                    'name' => 'name',
                    'data' => 'name',
                    'label' => 'Name',
                    'width' => '200px',
                    'className' => '',
                    'orderable' => true
                ],
                [
                    'name' => 'slug',
                    'data' => 'slug',
                    'label' => 'Slug',
                    'width' => '200px',
                    'className' => '',
                    'orderable' => true
                ],
                [
                    'name' => 'published_at',
                    'data' => 'published_at',
                    'label' => 'Published',
                    'width' => '100px',
                    'className' => 'text-center',
                    'orderable' => true
                ],
                [
                    'name' => 'updated_at',
                    'data' => 'updated_at',
                    'label' => 'Last Activity',
                    'width' => '100px',
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
        $this->title = 'Create Category';
        $this->breadcrumb = [
            'Home',
            'Category',
            'Create'
        ];

        return $this->render('create', []);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'min:3']
        ]);

        Category::createData($request);

        return redirect()->route($this->route . 'index')
            ->with('status', 'success')
            ->with('message', 'Success Create Category');
    }

    public function show($id)
    {
        return view('config::show');
    }

    public function edit(Category $category)
    {
        $this->title = 'Edit Category';
        $this->breadcrumb = [
            'Home',
            'Category',
            'Edit'
        ];

        return $this->render('edit', [
            'category' => $category
        ]);
    }

    public function update(Category $category, Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'min:3']
        ]);

        Category::updateData($category, $request);

        return redirect()->route($this->route . 'index')
            ->with('status', 'success')
            ->with('message', 'Success Update Category');
    }

    public function destroy(Category $category)
    {
        Category::deleteData($category);

        return redirect()->route($this->route . 'index')
            ->with('status', 'success')
            ->with('message', 'Success Delete Category');
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
        $categorys = Category::datatables();

        return DataTables::of($categorys)
            ->editColumn('image', function ($category) {
                return $this->makeImageForDatatables($category->image);
            })
            ->editColumn('updated_at', function ($category) {
                return $this->makeLastActivity($category);
            })
            ->editColumn('published_at', function ($category) {
                return $this->makePublishedAtStatus($category->published_at);
            })
            ->addColumn('actions', function ($category) {
                $actions[] = (object) [
                    'type' => 'link',
                    'name' => 'edit',
                    'label' => 'Edit',
                    'icon' => 'fas fa-edit',
                    'url' => route($this->route . 'edit', $category->id),
                    'tooltip' => ''
                ];

                $actions[] = (object) [
                    'type' => 'button',
                    'name' => 'delete',
                    'label' => 'Delete',
                    'icon' => 'fas fa-trash',
                    'url' => route($this->route . 'destroy', $category->id),
                    'onclick' => 'window.deleteComfirmation(this)',
                    'tooltip' => ''
                ];

                return $this->makeActionButtons($actions);
            })
            ->rawColumns(['actions', 'published_at', 'image', 'updated_at'])
            ->make(true);
    }
}
