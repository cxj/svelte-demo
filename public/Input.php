<?php
/**
 * @file Input.php
 * Replace with one line description.
 */

namespace Cxj;


use Psr\Http\Message\ServerRequestInterface;


class Input
{
    /**
     * @param ServerRequestInterface $request
     * @return array
     */
    public function __invoke(ServerRequestInterface $request)
    {
        $input = [
            array_merge(
                (array)$request->getQueryParams(),
                (array)$request->getAttributes(),
                (array)$request->getParsedBody(),
                (array)$request->getUploadedFiles(),
                $this->getDecodedJsonBody($request)
            )
        ];

        // error_log(__CLASS__ . " input: " . print_r($input, true));

        return $input;
    }

    /**
     * Superglobals have everything! ...except the body.  PSR ServerRequest
     * has everything! ...except non-MIME body data.  Sigh.
     *
     * @param $request ServerRequestInterface
     * @return array
     */
    protected function getDecodedJsonBody($request): array
    {
        $body = (string)$request->getBody();
        if (empty($body)) {
            return [];
        }
        $json = json_decode($body);
        if ($json === null) {
            // TODO real logging.
            error_log(
                "json_decode failed with message: " . json_last_error_msg()
            );
            error_log("bad JSON was: '$body'");

            return [];
        }

        return (array)$json;
    }
}
