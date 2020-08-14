<?php
/**
 * @file DeleteLogo.php
 * Replace with one line description.
 */

namespace Cxj;


use Aura\Payload\Payload;


class DeleteLogo extends AbstractApp
{

    protected function exec(array $input): Payload
    {
        if (!isset($input['id'])) {
            return $this->failure(['msg' => 'input key id missing']);
        }
        $id = $input['id'];

        // Find the pathname matching the ID.
        $list = $this->logoList->fetchAll();
        foreach ($list as $key => $logo) {
            if ($logo->id === $id) {
                error_log(__CLASS__ . " deleting $id");
                if (false === rename($logo->path, "archive/$id")) {
                    $this->failure(['msg' => 'rename failed']);
                };
                break;
            }
        }

        return $this->success([]);
    }
}
