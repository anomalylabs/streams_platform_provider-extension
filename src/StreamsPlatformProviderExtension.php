<?php namespace Anomaly\StreamsPlatformProviderExtension;

use Anomaly\GithubProviderExtension\Command\MakeStreamsPlatformAccessToken;
use Anomaly\GithubProviderExtension\Command\MakeStreamsPlatformProvider;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Token\AccessToken;

class StreamsPlatformProviderExtension extends Extension
{

    /**
     * This extension provides the github
     * oauth provider for the API module.
     *
     * @var string
     */
    protected $provides = 'anomaly.module.api::oauth_provider.streams_platform';

    /**
     * Return a provider instance.
     *
     * @return AbstractProvider
     */
    public function make()
    {
        return $this->dispatch(new MakeStreamsPlatformProvider());
    }

    /**
     * Return the provider's access token.
     *
     * @return AccessToken
     */
    public function token()
    {
        return $this->dispatch(new MakeStreamsPlatformAccessToken());
    }

}
