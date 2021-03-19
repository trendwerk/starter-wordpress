// Rearange categories
var categories = {
  'core/buttons': 'text',
};

wp.hooks.addFilter('blocks.registerBlockType', 'starter', function(settings, name) {
  if (categories[name]) {
    settings.category = categories[name];
  }

  return settings;
});

// Remove block styles and format types
wp.domReady(() => {
  wp.blocks.unregisterBlockStyle('core/button', 'fill');
  wp.blocks.unregisterBlockStyle('core/button', 'outline');
  wp.blocks.unregisterBlockStyle('core/image', 'default');
  wp.blocks.unregisterBlockStyle('core/image', 'rounded');
  wp.blocks.unregisterBlockStyle('core/quote', 'default');
  wp.blocks.unregisterBlockStyle('core/quote', 'large');
  wp.richText.unregisterFormatType('core/code')
  wp.richText.unregisterFormatType('core/image')
});
