<?php
/**
 * @file AbstractApp.php
 * Replace with one line description.
 */

namespace Cxj;


use Aura\Payload\Payload;
use Aura\Payload_Interface\PayloadStatus;
use Exception;


abstract class AbstractApp
{
    protected LogoList $logoList;
    protected Payload $payload;

    public function __construct()
    {
        $this->logoList = new LogoList();
        $this->payload  = new Payload();
    }

    public function __invoke(array $input): Payload
    {
        try {
            // $this->resumeSession();
            $payload = $this->exec($input);

            $payload->setInput($input);
            $payload->setExtras(
                [
                    // 'user'        => $this->user,
                    'sessionName' => session_name(),
                    'sessionId'   => session_id(),
                    // 'session'     => new SessionService(),
                ]
            );

            return $payload;
        }
        catch (Exception $e) {

        }
    }

    protected function success($output): Payload
    {
        return $this->payload->setStatus(PayloadStatus::SUCCESS)
                             ->setOutput($output);
    }

    protected function failure($output): Payload
    {
        return $this->payload->setStatus(PayloadStatus::FAILURE)
                             ->setOutput($output);
    }

    abstract protected function exec(array $input): Payload;
}
