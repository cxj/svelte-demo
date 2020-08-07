<?php
/**
 * @file LogoList.php
 * Replace with one line description.
 */

namespace Cxj;


use RuntimeException;
use stdClass;


class LogoList
{
    const logoDir = "./logos";

    private array $list;

    public function __construct()
    {
        error_log(__METHOD__);
        $dir = dir("./logos");
        if (null === $dir || false === $dir) {
            throw new RuntimeException(
                "Cannot read logo directory: " . self::logoDir
            );
        }

        $i          = 0;
        $this->list = [];
        while (false !== ($entry = $dir->read())) {
            $i++;
            $path = "logos/" . $entry;
            if (is_file($path) && is_readable($path)) {
                $file         = new class() {
                    public string $id;
                    public string $path;
                };
                $file->id     = "$i";
                $file->path   = $path;
                $this->list[] = $file;
            };
        }
    }

    public function fetchAll(): array
    {
        error_log(__METHOD__);
        return $this->list;
    }

    /**
     * Randomly returns just one logo object from the list.
     * @return object
     */
    public function fetchRandom(): object   // anonymous class
    {
        error_log(__METHOD__);
        return $this->list[mt_rand(0, count($this->list) - 1)];
    }
}
