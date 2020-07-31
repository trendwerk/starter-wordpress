// Rearange categories
var categories = {
  'core/buttons': 'text',
  'core/heading': 'text',
  'core/list': 'text',
  'core/paragraph': 'text',
  'core/quote': 'text',
  'core/gallery': 'media',
  'core/image': 'media',
  'core/embed': 'advanced',
  'core/html': 'advanced',
  'core/table': 'advanced',
};

wp.hooks.addFilter('blocks.registerBlockType', 'headless', function(settings, name) {
  if (categories[name]) {
    settings.category = categories[name];
  }

  return settings;
});

// Remove block styles
wp.domReady(() => {
  wp.blocks.unregisterBlockStyle('core/button', 'fill');
  wp.blocks.unregisterBlockStyle('core/button', 'outline');
  wp.blocks.unregisterBlockStyle('core/image', 'default');
  wp.blocks.unregisterBlockStyle('core/image', 'rounded');
  wp.blocks.unregisterBlockStyle('core/quote', 'default');
  wp.blocks.unregisterBlockStyle('core/quote', 'large');
});
