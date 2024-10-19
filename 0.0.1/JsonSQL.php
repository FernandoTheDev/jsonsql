<?php

/*
 * Developer by: @FernandoTheDev <- Telegram
 * 08/08/2023 at 21:17
 */

class JsonSQL
{
	public $file_json;

	public function __construct($file)
	{
		$this->file_json = $file;
	}

	private function getDataFile()
	{
		$data = file_get_contents($this->file_json);
		return json_decode($data, true);
	}

	public function select($key = NULL, $array = NULL)
	{
		$data_file = $this->getDataFile();

		if (is_null($key) and is_null($array)) {
			return $data_file;
		} else if (!is_null($key) and is_null($array)) {
			if (array_key_exists($key, $data_file)) {
				return $data_file[$key];
			} else {
				return false;
			}
		} else if ((!is_null($key) and !is_null($array))) {
			if (array_key_exists($key, $data_file)) {
				$array_user = [];

				foreach ($data_file as $user => $values) {
					if ($user == $key) {
						foreach ($array as $specific) {
							$array_user[] = $values[$specific];
						}
					}
				}

				return $array_user;
			} else {
				return false;
			}
		}
	}

	public function deleta($key = NULL, $array = NULL)
	{
		$data_file = $this->getDataFile();

		if (is_null($key) and is_null($array)) {
			return false;
		} else if (!is_null($key) and is_null($array)) {
			if (array_key_exists($key, $data_file)) {
				unset($data_file[$key]);

				$save_file = json_encode($data_file, JSON_PRETTY_PRINT);
				$save_file = file_put_contents($this->file_json, $save_file);

				if ($save_file) {
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		} else if ((!is_null($key) and !is_null($array))) {
			if (array_key_exists($key, $data_file)) {
				foreach ($data_file as $user => $values) {
					if ($user == $key) {
						foreach ($array as $specific) {
							unset($data_file[$key][$specific]);
						}
					}
				}

				$save_file = json_encode($data_file, JSON_PRETTY_PRINT);
				$save_file = file_put_contents($this->file_json, $save_file);

				if ($save_file) {
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}
	}

	public function insert($key = NULL, $array = NULL)
	{
		$data_file = $this->getDataFile();

		if (is_null($key) or is_null($array)) {
			return false;
		} else if (!is_null($key) and !is_null($array)) {
			if (!array_key_exists($key, $data_file)) {
				$data_file[$key] = $array;

				$save_file = json_encode($data_file, JSON_PRETTY_PRINT);
				$save_file = file_put_contents($this->file_json, $save_file);

				if ($save_file) {
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}
	}

	public function edit($key = NULL, $array = NULL)
	{
		$data_file = file_get_contents($this->file_json);
		$data_file = json_decode($data_file, true);

		if (is_null($key) and is_null($array)) {
			return false;
		} else if (!is_null($key) and is_null($array) and is_array($key)) {
			foreach ($data_file as $user => $data) {
				foreach ($key as $specific => $values) {
					$data_file[$user][$specific] = $values;
				}
			}

			$save_file = json_encode($data_file, JSON_PRETTY_PRINT);
			$save_file = file_put_contents($this->file_json, $save_file);

			if ($save_file) {
				return true;
			} else {
				return false;
			}
		} else if ((!is_null($key) and !is_null($array))) {
			if (array_key_exists($key, $data_file)) {
				foreach ($array as $specific => $values) {
					$data_file[$key][$specific] = $values;
				}

				$save_file = json_encode($data_file, JSON_PRETTY_PRINT);
				$save_file = file_put_contents($this->file_json, $save_file);

				if ($save_file) {
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}
	}
}
