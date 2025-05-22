<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GalleryResource;
use App\Services\GalleryService;
use Illuminate\Http\Request;

class GalleryController extends Controller
{

   public function __construct(
        protected GalleryService $galleryService
   )
   {} 

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = $this->galleryService->getRandomImages();

        return response()->json([
            'success' => true,
            'data' => GalleryResource::collection($images),
        ]);
    }
}
