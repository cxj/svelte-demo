<?php
declare(strict_types=1);
namespace Cxj;

use Aura\Payload\Payload;


class AllLogos extends AbstractApp
{
    public function exec(array $input): Payload
    {
        $list = $this->logoList->fetchAll();
        // randomize the elements in the array:
        shuffle($list);


        error_log(count($list) . " logo files encoded");

        return $this->success($list);
    }
}
