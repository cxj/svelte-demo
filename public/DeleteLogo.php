<?php
/**
 * @file DeleteLogo.php
 * Replace with one line description.
 */

namespace Cxj;


use Aura\Payload\Payload;


class DeleteLogo extends AbstractApp
{
    const ARCHIVE_DIR = "archive" . DIRECTORY_SEPARATOR;

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
                if ($this->archiveFile($logo->path)) {
                    return $this->success([]);
                }
                else {
                    $this->failure(['msg' => 'rename failed']);
                }
            }
        }
        $this->failure(['msg' => 'rename failed']);
    }

    protected function archiveFile(string $file): bool
    {
        if (!is_dir(self::ARCHIVE_DIR)) {
            mkdir(self::ARCHIVE_DIR);
        }

        error_log("Renaming $file to " . self::ARCHIVE_DIR . basename($file));
        
        return rename($file, self::ARCHIVE_DIR . basename($file));
    }
}
