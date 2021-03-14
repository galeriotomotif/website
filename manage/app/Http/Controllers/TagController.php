<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Post\Tag;

class TagController extends Controller
{
    public function __construct()
    {
        $this->title = 'Tag';
        $this->breadcrumb = [
            'Home',
            'Tag',
        ];
        $this->route = 'tag.';
        $this->view = 'tag.';
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
        $this->title = 'Create Tag';
        $this->breadcrumb = [
            'Home',
            'Tag',
            'Create'
        ];

        return $this->render('create', []);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'min:3']
        ]);

        Tag::createData($request);

        return redirect()->route($this->route . 'index')
            ->with('status', 'success')
            ->with('message', 'Success Create Tag');
    }

    public function show($id)
    {
        return view('config::show');
    }

    public function edit(Tag $tag)
    {
        $this->title = 'Edit Tag';
        $this->breadcrumb = [
            'Home',
            'Tag',
            'Edit'
        ];

        return $this->render('edit', [
            'tag' => $tag
        ]);
    }

    public function update(Tag $tag, Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'min:3']
        ]);

        Tag::updateData($tag, $request);

        return redirect()->route($this->route . 'index')
            ->with('status', 'success')
            ->with('message', 'Success Update Tag');
    }

    public function destroy(Tag $tag)
    {
        Tag::deleteData($tag);

        return redirect()->route($this->route . 'index')
            ->with('status', 'success')
            ->with('message', 'Success Delete Tag');
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
        $tags = Tag::datatables();

        return DataTables::of($tags)
            ->editColumn('image', function ($tag) {
                return $this->makeImageForDatatables($tag->image);
            })
            ->editColumn('updated_at', function ($tag) {
                return $this->makeLastActivity($tag);
            })
            ->editColumn('published_at', function ($tag) {
                return $this->makePublishedAtStatus($tag->published_at);
            })
            ->addColumn('actions', function ($tag) {
                $actions[] = (object) [
                    'type' => 'link',
                    'name' => 'edit',
                    'label' => 'Edit',
                    'icon' => 'fas fa-edit',
                    'url' => route($this->route . 'edit', $tag->id),
                    'tooltip' => ''
                ];

                $actions[] = (object) [
                    'type' => 'button',
                    'name' => 'delete',
                    'label' => 'Delete',
                    'icon' => 'fas fa-trash',
                    'url' => route($this->route . 'destroy', $tag->id),
                    'onclick' => 'window.deleteComfirmation(this)',
                    'tooltip' => ''
                ];

                return $this->makeActionButtons($actions);
            })
            ->rawColumns(['actions', 'published_at', 'image', 'updated_at'])
            ->make(true);
    }
}
