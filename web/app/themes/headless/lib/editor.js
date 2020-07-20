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
