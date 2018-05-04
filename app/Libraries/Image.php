<?php 

namespace App\Libraries;

use Illuminate\Http\Request;
use Carbon\Carbon;

class Image {

	public $header_image_url 		= 'ImageURL';
	public $original_path_prefix 	= 'images/original';
	public $optimized_path_prefix 	= 'app/public/images/optimized';

	public $dir_name;
	public $name;
	public $original_url;
	public $original_path;
	public $optimized_path;

	public function __construct(Request $request)
	{
		$this->dir_name = 
			Carbon::now()->format('Y-m') . '/' . 
			Carbon::now()->format('d') . '/' . 
			Carbon::now()->format('H') . '/' . 
			str_slug($request->header('host'));

		$this->original_url = $request->header($this->header_image_url);
		$this->name = substr($this->original_url, strrpos($this->original_url, '/') + 1);

		$this->original_path = $this->original_path_prefix . '/' . $this->dir_name . '/' . $this->name;
		$this->optimized_path = storage_path($this->optimized_path_prefix . '/' . $this->dir_name);

		if(! is_dir($this->optimized_path))
		{
			mkdir($this->optimized_path, 0777, true);
		}

		$this->optimized_path .= '/' . $this->name;
	}
}
