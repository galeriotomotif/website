<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Post;
use App\Models\Post\Category;
use App\Models\Post\Tag;

class PostController extends Controller
{
    public function __construct()
    {
        $this->title = 'Post';
        $this->breadcrumb = [
            'Home',
            'Post',
        ];
        $this->route = 'post.';
        $this->view = 'post.';
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
                    'width' => '150px',
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
                    'name' => 'category_id',
                    'data' => 'category_id',
                    'label' => 'Category',
                    'width' => '100px',
                    'className' => '',
                    'orderable' => true
                ],
                [
                    'name' => 'tags',
                    'data' => 'tags',
                    'label' => 'Tags',
                    'width' => '100px',
                    'className' => '',
                    'orderable' => false
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
                    'width' => '150px',
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
        $this->title = 'Create Post';
        $this->breadcrumb = [
            'Home',
            'Post',
            'Create'
        ];

        return $this->render('create', [
            'categories' => Category::all(),
            'tags' => Tag::all()
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'min:3']
        ]);

        Post::createData($request);

        return redirect()->route($this->route . 'index')
            ->with('status', 'success')
            ->with('message', 'Success Create Post');
    }

    public function show($id)
    {
        return view('config::show');
    }

    public function edit(Post $post)
    {
        $this->title = 'Edit Post';
        $this->breadcrumb = [
            'Home',
            'Post',
            'Edit'
        ];

        return $this->render('edit', [
            'post' => $post,
            'categories' => Category::all(),
            'tags' => Tag::all()
        ]);
    }

    public function update(Post $post, Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'min:3']
        ]);

        Post::updateData($post, $request);

        return redirect()->route($this->route . 'index')
            ->with('status', 'success')
            ->with('message', 'Success Update Post');
    }

    public function destroy(Post $post)
    {
        Post::deleteData($post);

        return redirect()->route($this->route . 'index')
            ->with('status', 'success')
            ->with('message', 'Success Delete Post');
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
        $posts = Post::datatables();

        return DataTables::of($posts)
            ->editColumn('image', function ($post) {
                return $this->makeImageForDatatables($post->image);
            })
            ->editColumn('updated_at', function ($post) {
                return $this->makeLastActivity($post);
            })
            ->editColumn('published_at', function ($post) {
                return $this->makePublishedAtStatus($post->published_at);
            })
            ->addColumn('tags', function($post){
                $tags = '';

                foreach ($post->tags as $key => $value) {
                    $tags .= "<span class='badge badge-info mr-1'>$value->name</span>";
                }

                return $tags;
            })
            ->editColumn('category_id', function($post){
                if(!$post->category){
                    return "Not Categorable";
                }
                $categoryName = $post->category->name;
                return "<span class='badge badge-info'>$categoryName</span>";
            })
            ->addColumn('actions', function ($post) {
                $actions[] = (object) [
                    'type' => 'link',
                    'name' => 'edit',
                    'label' => 'Edit',
                    'icon' => 'fas fa-edit',
                    'url' => route($this->route . 'edit', $post->id),
                    'tooltip' => ''
                ];

                $actions[] = (object) [
                    'type' => 'button',
                    'name' => 'delete',
                    'label' => 'Delete',
                    'icon' => 'fas fa-trash',
                    'url' => route($this->route . 'destroy', $post->id),
                    'onclick' => 'window.deleteComfirmation(this)',
                    'tooltip' => ''
                ];

                return $this->makeActionButtons($actions);
            })
            ->rawColumns(['actions', 'published_at', 'image', 'tags', 'category_id', 'updated_at'])
            ->make(true);
    }
}
