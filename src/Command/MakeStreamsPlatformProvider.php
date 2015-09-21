<?php namespace Anomaly\StreamsPlatformProviderExtension\Command;

use Anomaly\EncryptedFieldType\EncryptedFieldTypePresenter;
use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\UrlFieldType\UrlFieldTypePresenter;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Http\Request;
use League\OAuth2\Client\Provider\GenericProvider;

/**
 * Class MakeStreamsPlatformProvider
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\StreamsPlatformProviderExtension\Command
 */
class MakeStreamsPlatformProvider implements SelfHandling
{

    /**
     * Handle the command.
     *
     * @param SettingRepositoryInterface $settings
     * @param Request                    $request
     * @return GenericProvider
     */
    public function handle(SettingRepositoryInterface $settings, Request $request)
    {
        /* @var EncryptedFieldTypePresenter $clientId */
        /* @var EncryptedFieldTypePresenter $clientSecret */
        /* @var UrlFieldTypePresenter $clientDomain */
        $clientId     = $settings->value('anomaly.extension.streams_platform_provider::client_id');
        $clientSecret = $settings->value('anomaly.extension.streams_platform_provider::client_secret');
        $clientDomain = $settings->value('anomaly.extension.streams_platform_provider::client_domain');

        return new GenericProvider(
            [
                'clientId'                => $clientId->decrypted(),
                'clientSecret'            => $clientSecret->decrypted(),
                'redirectUri'             => $request->fullUrl(),
                'urlAuthorize'            => $clientDomain->to('api/authorize'),
                'urlAccessToken'          => $clientDomain->to('api/token'),
                'urlResourceOwnerDetails' => $clientDomain->to('api/owner'),
            ]
        );
    }
}
