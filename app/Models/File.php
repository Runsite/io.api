<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Libraries\Image;

class File extends Model
{
	protected $table = 'files';
	protected $fillable = ['path'];

	protected $image;

	public function __construct($attributes = [])
	{
		parent::__construct($attributes);
		$this->image = app()->make(Image::class);
	}

	public function remove()
	{
		if(file_exists(storage_path('app/'. $this->original_path)))
		{
			unlink(storage_path('app/'. $this->original_path));
		}

		if(file_exists($this->image->optimized_path))
		{
			unlink($this->image->optimized_path);
		}

		return $this->delete();
	}
}
