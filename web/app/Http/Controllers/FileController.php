<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class FileController extends Controller
{
    public function showFile($path)
    {
        return response()->file(Storage::disk('local')->path($path));
    }

    public function showImageAspecRatio(Request $request)
    {
        try {
            $image = Storage::disk('local')->path($request->path);
            $image = Image::make($image);
            $image = $image->resize(null, 2000, function ($constraint) {
                $constraint->aspectRatio();
            });

            switch ($request->ratio) {
                case '16x9':
                    $image = $image->fit(1280, 720);
                    break;
                case '4x3':
                    $image = $image->fit(600, 450);
                    break;
                case '1x1':
                    $image = $image->fit(500, 500);
                    break;
                default:
                    abort(404);
                    break;
            }

            return $image->response('jpeg');
        } catch (\Throwable $th) {
            abort(404);
        }
    }

    private function createImage($aspecRatio = '16:9')
    { }
}
