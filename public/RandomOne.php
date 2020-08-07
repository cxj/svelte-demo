<?php
/**
 * @file RandomOne.php
 * Replace with one line description.
 */

namespace Cxj;


use Aura\Payload\Payload;


class RandomOne extends AbstractApp
{
    public function exec(array $input): Payload
    {
        error_log(__METHOD__);

        $logo = $this->logoList->fetchRandom();

        return $this->success($logo);
    }
}
