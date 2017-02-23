<?php

namespace Drupal\pnx_formatters\Plugin\DsField;

use Drupal\ds\Plugin\DsField\DsFieldBase;
use Drupal\views\Plugin\views\display\DisplayPluginBase;

/**
 * Plugin that renders a view.
 *
 * @DsField(
 *   title = @Translation("Views View"),
 *   id = "render_views_view",
 *   entity_type = "node",
 *   provider = "node"
 * )
 */
class RenderViewsView extends DsFieldBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return DisplayPluginBase::buildBasicRenderable('sustainability', 'block_1'); // @todo make view configurable
  }

}
