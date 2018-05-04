<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use ImageOptimizer;
use App\Models\File;
use App\Libraries\Image;

class ImagesController extends Controller
{
	protected $image = null;

	public function __construct(Image $image)
	{
		$this->image = $image;
	}

	public function optimize()
	{
		// Downloading image
		$image_data = @file_get_contents($this->image->original_url);

		if(! $image_data)
		{
			return response('Unable to load image.', 400);
		}

		// Saving image
		Storage::put($this->image->original_path, $image_data);

		// Optimization
		ImageOptimizer::optimize(storage_path('app/' . $this->image->original_path), $this->image->optimized_path);

		File::create([
			'path' => $this->image->dir_name . '/' . $this->image->name,
		]);

		// Returning optimized image and information
		return response()->json([
			'optimized_image_url' => asset('storage/images/optimized/' . $this->image->dir_name . '/' . $this->image->name)
		]);
	}
}
