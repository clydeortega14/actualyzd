<?php

namespace App\Http\Traits\Files;

trait FileTrait {

	public function manage($file)
	{
		return [

			'filename' => $file->getClientOriginalName(),
			'extension' => $file->extension(),
		];
	}

	public function fileNameToStore($file)
	{
		$filename_only = pathinfo($this->manage($file)['filename'], PATHINFO_FILENAME);

		return $filename_only.'-'.time().'.'.$this->manage($file)['extension'];
	}

	public function storeToStorage($file, $path)
	{
		return $file->storeAs($path, $this->fileNameToStore($file));
	}

	public function handleSingleFile($file, $path)
	{
		$filename = $this->fileNameToStore($file);

		$this->storeToStorage($file, $path);
	}
}