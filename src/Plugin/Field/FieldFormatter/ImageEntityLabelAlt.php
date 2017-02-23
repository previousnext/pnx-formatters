<?php

namespace Drupal\pnx_formatters\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\image\Plugin\Field\FieldFormatter\ImageFormatter;

/**
 * Plugin implementation of the 'image_entity_label_alt' formatter.
 *
 * @FieldFormatter(
 *   id = "image_entity_label_alt",
 *   label = @Translation("Image with entity label as alt text"),
 *   field_types = {
 *     "image"
 *   }
 * )
 */
class ImageEntityLabelAlt extends ImageFormatter {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = parent::viewElements($items, $langcode);
    foreach ($elements as &$element) {
      // Find the entity label.
      $entity = $element['#item']->getEntity();
      // Attach it as alt text.
      $element['#item_attributes']['alt'] = $entity->label();
    }

    return $elements;
  }

}
