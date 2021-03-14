<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Page;

class PageController extends Controller
{
    public function __construct()
    {
        $this->title = 'Page';
        $this->breadcrumb = [
            'Home',
            'Page',
        ];
        $this->route = 'page.';
        $this->view = 'page.';
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
        $this->title = 'Create Page';
        $this->breadcrumb = [
            'Home',
            'Page',
            'Create'
        ];

        return $this->render('create', []);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'min:3']
        ]);

        Page::createData($request);

        return redirect()->route($this->route . 'index')
            ->with('status', 'success')
            ->with('message', 'Success Create Page');
    }

    public function show($id)
    {
        return view('config::show');
    }

    public function edit(Page $page)
    {
        $this->title = 'Edit Page';
        $this->breadcrumb = [
            'Home',
            'Page',
            'Edit'
        ];

        return $this->render('edit', [
            'page' => $page
        ]);
    }

    public function update(Page $page, Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'min:3']
        ]);

        Page::updateData($page, $request);

        return redirect()->route($this->route . 'index')
            ->with('status', 'success')
            ->with('message', 'Success Update Page');
    }

    public function destroy(Page $page)
    {
        Page::deleteData($page);

        return redirect()->route($this->route . 'index')
            ->with('status', 'success')
            ->with('message', 'Success Delete Page');
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
        $pages = Page::datatables();

        return DataTables::of($pages)
            ->editColumn('image', function ($page) {
                return $this->makeImageForDatatables($page->image);
            })
            ->editColumn('updated_at', function ($page) {
                return $this->makeLastActivity($page);
            })
            ->editColumn('published_at', function ($page) {
                return $this->makePublishedAtStatus($page->published_at);
            })
            ->addColumn('actions', function ($page) {
                $actions[] = (object) [
                    'type' => 'link',
                    'name' => 'edit',
                    'label' => 'Edit',
                    'icon' => 'fas fa-edit',
                    'url' => route($this->route . 'edit', $page->id),
                    'tooltip' => ''
                ];

                $actions[] = (object) [
                    'type' => 'button',
                    'name' => 'delete',
                    'label' => 'Delete',
                    'icon' => 'fas fa-trash',
                    'url' => route($this->route . 'destroy', $page->id),
                    'onclick' => 'window.deleteComfirmation(this)',
                    'tooltip' => ''
                ];

                return $this->makeActionButtons($actions);
            })
            ->rawColumns(['actions', 'published_at', 'image', 'updated_at'])
            ->make(true);
    }
}
