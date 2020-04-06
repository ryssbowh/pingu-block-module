# Block

Provides an API to define blocks to be added to pages.

## Blocks 

Each block instance is saved in db (table blocks) along with its provider.
When working with a block model you'll need to call $block->instance() to get the actual block (that implements `BlockContract`), it could be a TextBlock or any class you've defined depending on the provider set for that block.
Or you can use the facade `\Blocks::load($id)` to load a block instance (`\Blocks::load(Block $block)` also works).

To access the block model in a block instance, call `$instance->blockModel()`.
To access the provider (that implements `BlockProviderContract`) in a block instance, call `$instance->resolveProvider()`.

## Providers

Each block is provided by a provider that implements `BlockProviderContract`. This package provides with one provider `SystemBlockProvider` on which all class defined block must be registered.

New providers must be registered on the Block facade : `\Blocks::registerProvider(SystemBlockProvider::class);`

Providers must implements the method `getRegisteredBlocks` which tells the application which blocks are available through this provider.

### SystemBlockProvider block provider

Allows developers to define classes that provide blocks.
Such a class would implement `BlockContract`.
To make your block available you'll need to register it in the `SystemBlockProvider` facade : `\SystemBlockProvider::register(MyBlock::class);`

### Caching

Registered blocks are saved in cache if the config `block.useCache` is true

### Commands

- make-block
- module:make-block