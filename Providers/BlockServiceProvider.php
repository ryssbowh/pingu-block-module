<?php

namespace Pingu\Block\Providers;

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Routing\Router;
use Pingu\Block\BlockCreator;
use Pingu\Block\BlockProviders\SystemBlockProvider;
use Pingu\Block\Blocks;
use Pingu\Block\Blocks\Test;
use Pingu\Block\Entities\Block;
use Pingu\Block\Entities\BlockText;
use Pingu\Core\Support\ModuleServiceProvider;

class BlockServiceProvider extends ModuleServiceProvider
{
    protected $entities = [
        Block::class
    ];
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $this->registerEntities($this->entities);
        $this->registerConfig();
        $this->loadModuleViewsFrom(__DIR__ . '/../Resources/views', 'block');
        \SystemBlocks::register(Test::class);
        \Route::bind(
            'block_name', function ($value, $route) {
                return \Blocks::resolveBlock($value);
            }
        );

        \JsConfig::setMany(
            [
            'block.uris.create' => Block::uris()->get('create', ajaxPrefix()),
            'block.uris.store' => Block::uris()->get('store', ajaxPrefix()),
            'block.uris.delete' => Block::uris()->get('delete', ajaxPrefix()),
            'block.uris.edit' => Block::uris()->get('edit', ajaxPrefix()),
            'block.uris.update' => Block::uris()->get('update', ajaxPrefix()),
            ]
        );

        \Asset::container('modules')->add('block-js', 'module-assets/Block.js');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('blocks', Blocks::class);
        \Blocks::registerProvider(SystemBlockProvider::class);
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/block');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'block');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'block');
        }
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'block'
        );
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('block.php')
        ], 'block-config');
    }
}
