<?php

namespace YouCan\Shop\Sdk\Client\HTTPAdapter;

class HTTPAdapterPicker
{
    public function pickAdapter(bool $isSandboxMode)
    {
        if ($this->guzzleIsDetected()) {
            $guzzleVersion = $this->guzzleMajorVersionNumber();

            if ($guzzleVersion && in_array($guzzleVersion, [6, 7])) {
                return new Guzzle67HTTPAdapter($isSandboxMode);
            }

            throw new \Exception('unsupported guzzle version, we support 6 or 7');
        }

        return new CurlHTTPAdapter($isSandboxMode);
    }

    /**
     * @return bool
     */
    private function guzzleIsDetected(): bool
    {
        return interface_exists("\GuzzleHttp\ClientInterface");
    }

    /**
     * @return int|null
     */
    private function guzzleMajorVersionNumber(): ?int
    {
        // Guzzle 7
        if (defined('\GuzzleHttp\ClientInterface::MAJOR_VERSION')) {
            return (int)\GuzzleHttp\ClientInterface::MAJOR_VERSION;
        }

        // Before Guzzle 7
        if (defined('\GuzzleHttp\ClientInterface::VERSION')) {
            return (int)\GuzzleHttp\ClientInterface::VERSION[0];
        }

        return null;
    }
}
