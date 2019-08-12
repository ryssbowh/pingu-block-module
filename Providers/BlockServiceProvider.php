<?php

namespace Pingu\Block\Providers;

use Illuminate\Database\Eloquent\Factory;
use Pingu\Block\BlockCreator;
use Pingu\Block\BlockProviders\DbBlockProvider;
use Pingu\Block\Blocks;
use Pingu\Block\Entities\Block;
use Pingu\Block\Entities\BlockText;
use Pingu\Core\Support\ModuleServiceProvider;

class BlockServiceProvider extends ModuleServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerModelSlugs(__DIR__.'/../'.$this->modelFolder);
        $this->registerTranslations();
        $this->registerConfig();
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'block');
        $this->registerFactories();
        $this->registerCreatorModels();
        //$this->registerAssets();
    }

    /**
     * Register js and css for this module
     */
    public function registerAssets()
    {
        \Asset::container('modules')->add('block-js', 'module-assets/Block.js');
        \Asset::container('modules')->add('block-css', 'module-assets/Block.css');
    }

    public function registerCreatorModels()
    {
        \BlockCreator::registerModel(BlockText::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('blocks', Blocks::class);
        $this->app->singleton('block', Block::class);
        $this->app->singleton('block.creator', BlockCreator::class);
        $this->app->singleton('block.providers.db', DbBlockProvider::class);
        $this->app->register(RouteServiceProvider::class);
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
     * Register an additional directory of factories.
     * 
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production')) {
            app(Factory::class)->load(__DIR__ . '/../Database/factories');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'block.providers.db'
        ];
    }
}
