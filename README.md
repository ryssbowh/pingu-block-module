# Block

Provides an API to define blocks to be added to pages.

## Blocks 

Each block instance is saved in db (table blocks) along with its provider.
When working with a block model you'll need to call $block->instance() to get the actual block (that implements `BlockContract`), it could be a TextBlock or any class you've defined depending on the provider set for that block.
Or you can use the facade `\Blocks::load($id)` to load a block instance (`\Blocks::load(Block $block)` also works).

Each block instance define a `render` method that you can override to load a specific view.

To access the block model in a block instance, call `$instance->getBlock()`.
To access the provider (that extends `Pingu\Block\Support\BlockProvider`) in a block instance, call `$instance->getProvider()`.
To access the model provider in a block model, call `$block->provider`

## Providers

Each block is provided by a provider that extends `Pingu\Block\Support\BlockProvider`. This package provides with two providers `ClassBlockProvider` and `DbBlockProvider`

To add a new provider, add a line in the block_providers table eg :
```
BlockProvider::create([
	'class' => MyNewProvider::class,
	'name' => 'something'
]);
```

And you need to register it in the container (deferred preferably) :

`$this->app->singleton(MyNewProvider::class, function($app){
    return new MyNewProvider;
});`

### ClassBlockProvider

Allows developers to define classes that provide blocks.
Such a class would implement `BlockContract` and optionnaly use the Trait `ClassBlock`.
To make the block available in pages you'll need to add a line in the block table referencing your class eg:
```
$p = BlockProvider::findByClass(ClassBlockProvider::class);

$block = new Block([
    'data' => [
        'class' => MyNewBlockClass::class,
    ]
]);
$block->provider()->associate($p)->save();
```

### DbBlockProvider

Allows user to create blocks using models defined by developers.
Each of those models is a normal model that implements `CreatableBlockContract`, they have a block slug to represent them is urls (for creation/edition).
To create a new block model, you'll need to register it through the creator facade : `\BlockCreator::registerModel(MyModel::class)`, the facade will check that your block slug is not alreay used.
After that define your fields as usual in your model.

### Commands

- make-block
- module:make-block