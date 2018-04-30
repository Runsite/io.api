<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImagesController extends Controller
{
	public function optimize(Request $request)
	{
		$image_url = $request->header('ImageURL');

		// Downloading image

		// Detect type of image

		// Optimization

		// Returning optimized image and information
	}
}
