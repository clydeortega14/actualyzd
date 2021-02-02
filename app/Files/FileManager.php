<?php

namespace App\Files;

class FileManager
{
	protected $file;

	public function __construct($file)
	{
		$this->filename = $file->getClientOriginalName();

		$this->extension = $file->extension();
	}

	public function fileToStore()
	{
		// get first filename only
		$filename_only = pathinfo($this->filename, PATHINFO_FILENAME);

		return $filename_only.'-'.time().'.'.$this->extension();
	}

	public function storeToStorage($path)
	{
		return $this->filename->storeAs($path, $this->fileToStore());
	}
}