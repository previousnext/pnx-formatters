<?php

namespace Drupal\pnx_formatters\Plugin\DsField;

use Drupal\Component\Utility\Html;
use Drupal\ds\Plugin\DsField\Title;

/**
 * Plugin that renders the title with anchor.
 *
 * @DsField(
 *   id = "title_anchor",
 *   title = @Translation("Name with ID"),
 *   entity_type = "taxonomy_term",
 *   provider = "taxonomy"
 * )
 */
class TitleAnchor extends Title {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $field = $this->getFieldConfiguration();
    $entity_label = $this->entity()->label();
    $entity_label_id = strtolower(Html::cleanCssIdentifier($entity_label));

    return [
      '#type' => 'html_tag',
      '#tag' => $field['settings']['wrapper'],
      '#value' => $entity_label,
      '#attributes' => [
        'id' => $entity_label_id,
      ],
    ];
  }

}
