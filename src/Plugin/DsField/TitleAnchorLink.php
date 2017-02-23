<?php

namespace Drupal\pnx_formatters\Plugin\DsField;

use Drupal\Component\Utility\Html;
use Drupal\Core\Url;
use Drupal\ds\Plugin\DsField\Link;

/**
 * Plugin that renders the anchor link.
 *
 * @DsField(
 *   id = "title_anchor_link",
 *   title = @Translation("Anchor link"),
 *   entity_type = "taxonomy_term",
 *   provider = "taxonomy"
 * )
 */
class TitleAnchorLink extends Link {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $field = $this->getFieldConfiguration();
    $entity_label = strtolower(Html::cleanCssIdentifier($this->entity()->label()));

    return [
      '#type' => 'link',
      '#url' => Url::fromRoute('view.sustainability.page_1'), // @todo make URL configurable
      '#title' => $field['settings']['link text'],
      '#options' => [
        'fragment' => $entity_label,
      ],
    ];
  }

}
