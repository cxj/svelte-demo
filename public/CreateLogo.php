<?php
/**
 * @file CreateLogo.php
 * Replace with one line description.
 */

namespace Cxj;


use Aura\Payload\Payload;
use Laminas\Diactoros\UploadedFile;


class CreateLogo extends AbstractApp
{

    protected function exec(array $input): Payload
    {
        if (!isset($input['our-file'])) {
            return $this->failure(['msg' => 'file upload data missing']);
        }
        /**
         * @var UploadedFile $f
         */
        $f = $input['our-file'];

        error_log(__CLASS__ . " client file name: " . $f->getClientFilename());

        try {
            @$f->moveTo("./logos/" . $f->getClientFilename());
        }
        catch (\Exception $e) {
            return $this->failure(['msg' => "Exception: {$e->getMessage()}"]);
        }

        return $this->success([]);
    }
}
