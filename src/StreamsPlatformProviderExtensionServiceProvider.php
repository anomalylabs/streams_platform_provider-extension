<?php namespace Anomaly\StreamsPlatformProviderExtension;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

class StreamsPlatformProviderExtensionServiceProvider extends AddonServiceProvider
{

    protected $plugins = [];

    protected $routes = [];

    protected $middleware = [];

    protected $listeners = [];

    protected $providers = [];

    protected $singletons = [];

    protected $overrides = [];

    protected $mobile = [];

    public function register()
    {
    }

    public function map()
    {
    }

}
