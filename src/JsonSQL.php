<?php
namespace Fernando\JsonSQL;

/*
 * Developer by: @FernandoTheDev <- Telegram
 * Create 08/08/2023 at 21:17
 * Update 19/10/2024 at 18:41
 */

final class JsonSQL
{
    public string $json_file;

    public function __construct(string $file)
    {
        $this->json_file = $file;
    }

    private function getDataFile(): array
    {
        return json_decode(file_get_contents($this->json_file), true);
    }

    public function select(string|int $key = '', array $array = []): bool|array
    {
        $data_file = $this->getDataFile();

        if ($key === '' and $array == null) {
            return $data_file;
        }

        if ($key !== '' and $array == null) {
            return array_key_exists($key, $data_file) ? $data_file[$key] : false;
        }

        if (!array_key_exists($key, $data_file)) {
            return false;
        }

        $array_user = [];

        foreach ($data_file as $user => $values) {
            if ($user === $key) {
                foreach ($array as $specific) {
                    $array_user[] = $values[$specific];
                }
            }
        }

        return $array_user;
    }

    public function delete(string $key = '', array $array = []): bool
    {
        $data_file = $this->getDataFile();

        if ($key === '' and $array == null) {
            return false;
        }

        if ($key !== '' and $array == null) {
            if (!array_key_exists($key, $data_file)) {
                return false;
            }

            unset($data_file[$key]);

            $save_file = json_encode($data_file, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            $save_file = file_put_contents($this->json_file, $save_file);

            return $save_file;
        }

        if (!array_key_exists($key, $data_file)) {
            return false;
        }

        foreach ($data_file as $user => $values) {
            if ($user == $key) {
                foreach ($array as $specific) {
                    unset($data_file[$key][$specific]);
                }
            }
        }

        $save_file = json_encode($data_file, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $save_file = file_put_contents($this->json_file, $save_file);

        return $save_file;
    }

    public function insert(string $key = '', array $array = []): bool
    {
        $data_file = $this->getDataFile();

        if ($key === '' or $array == null) {
            return false;
        }

        if (array_key_exists($key, $data_file)) {
            return false;
        }

        $data_file[$key] = $array;

        $save_file = json_encode($data_file, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $save_file = file_put_contents($this->json_file, $save_file);

        return $save_file;
    }

    public function update(string $key = '', array $array = []): bool
    {
        $data_file = file_get_contents($this->json_file);
        $data_file = json_decode($data_file, true);

        if ($key == '' and $array == null) {
            return false;
        }

        if ($key == '' and $array !== null) {
            foreach ($data_file as $user => $data) {
                foreach ($array as $specific => $values) {
                    $data_file[$user][$specific] = $values;
                }
            }

            $save_file = json_encode($data_file, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            $save_file = file_put_contents($this->json_file, $save_file);

            return $save_file;
        }

        if (!array_key_exists($key, $data_file)) {
            return false;
        }

        foreach ($array as $specific => $values) {
            $data_file[$key][$specific] = $values;
        }

        $save_file = json_encode($data_file, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $save_file = file_put_contents($this->json_file, $save_file);

        return $save_file;
    }
}
