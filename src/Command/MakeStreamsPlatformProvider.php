<?php namespace Anomaly\GithubProviderExtension\Command;

use Anomaly\EncryptedFieldType\EncryptedFieldTypePresenter;
use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Http\Request;
use League\OAuth2\Client\Provider\Github;

/**
 * Class MakeStreamsPlatformProvider
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\GithubProviderExtension\Command
 */
class MakeStreamsPlatformProvider implements SelfHandling
{

    /**
     * Handle the command.
     *
     * @param SettingRepositoryInterface $settings
     * @param Request                    $request
     * @return Github
     */
    public function handle(SettingRepositoryInterface $settings, Request $request)
    {
        /* @var EncryptedFieldTypePresenter $clientId */
        /* @var EncryptedFieldTypePresenter $clientSecret */
        $clientId     = $settings->value('anomaly.extension.github_provider::client_id');
        $clientSecret = $settings->value('anomaly.extension.github_provider::client_secret');

        return new Github(
            [
                'clientId'     => $clientId->decrypted(),
                'clientSecret' => $clientSecret->decrypted(),
                'redirectUri'  => $request->fullUrl(),
            ]
        );
    }
}
