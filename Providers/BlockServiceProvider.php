<?php

namespace Pingu\Block\Providers;

use Illuminate\Database\Eloquent\Factory;
use Pingu\Block\BlockCreator;
use Pingu\Block\BlockProviders\ClassBlockProvider;
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
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'block');
        $this->registerCreatorModels();
    }

    /**
     * Registers models that can be used through the DbBlockProvider
     */
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
        $this->app->singleton('block.creator', function($app){
            return new BlockCreator;
        });
        $this->app->singleton(DbBlockProvider::class, function($app){
            return new DbBlockProvider;
        });
        $this->app->singleton(ClassBlockProvider::class, function($app){
            return new ClassBlockProvider;
        });
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
}
