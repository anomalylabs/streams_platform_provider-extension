<?php namespace Anomaly\GithubProviderExtension\Command;

use Anomaly\EncryptedFieldType\EncryptedFieldTypePresenter;
use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use League\OAuth2\Client\Token\AccessToken;

/**
 * Class MakeStreamsPlatformAccessToken
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\GithubProviderExtension\Command
 */
class MakeStreamsPlatformAccessToken implements SelfHandling
{

    /**
     * Handle the command.
     *
     * @param SettingRepositoryInterface $settings
     * @return AccessToken
     */
    public function handle(SettingRepositoryInterface $settings)
    {
        /* @var EncryptedFieldTypePresenter $setting */
        $setting = $settings->value('anomaly.extension.github_provider::access_token');

        if (!$setting) {
            throw new \Exception('Please generate tokens for the StreamsPlatform provider first.');
        }

        return new AccessToken(['access_token' => $setting->decrypted()]);
    }
}
