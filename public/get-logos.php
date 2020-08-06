<?php
declare(strict_types=1);

namespace Cxj;

class AllLogos
{
    public function get12Logos(): string
    {
        $dir = dir("./logos");
        if (null === $dir || false === $dir) {
            error_log("dir() failed with bad parameters or other error");

            return '[{"color":"red","id":"99","path":""}]';
        }

        $i    = 0;
        $list = [];
        while (false !== ($entry = $dir->read())) {
            $i++;
            $path = "logos/" . $entry;
            if (is_file($path) && is_readable($path)) {
                $file       = new class() {
                    public string $id;
                    public string $path;
                };
                $file->id   = "$i";
                $file->path = $path;
                $list[]     = $file;
            };
        }

        // randomize the elements in the array:
        shuffle($list);

        // Send only the first 12 to the App.
        $list = array_slice($list, 0, 12);

        // convert to JSON for output to AJAX/HTTP requests.
        $json = json_encode($list);
        error_log(json_last_error_msg());
        error_log(count($list) . " JSON elements encoded");

        return $json;
    }
}
