<?php
/**
 * @file SwapThree.php
 * Replace with one line description.
 */

namespace Cxj;


use Aura\Payload\Payload;


class SwapThree extends AbstractApp
{
    protected function exec(array $input): Payload
    {
        $post        = $input['post'];
        $currentGrid = $this->currentGrid($post);

        // error_log("currentGrid = " . print_r($currentGrid, true));

        // Pick randomly 3 VALUES.
        $pick3 = array_rand(array_flip($currentGrid), 3);

        // error_log("pick3 = " . print_r($pick3, true));

        // Now replace them with 3 items:
        $cell[1] = $this->logoList->fetchRandom();
        $cell[2] = $this->logoList->fetchRandom();
        $cell[3] = $this->logoList->fetchRandom();

        return $this->success($cell);
    }

    private function currentGrid($data): array
    {
        $grid = [];
        foreach ($data as $key => $object) {
            array_push($grid, $object->id);
        }
        return $grid;
    }
}
