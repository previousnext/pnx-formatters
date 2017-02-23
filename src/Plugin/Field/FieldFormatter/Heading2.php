<?php

namespace Drupal\pnx_formatters\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Component\Utility\Html;

/**
 * Formatter for displaying strings as headings.
 *
 * @FieldFormatter(
 *   id="heading_2",
 *   label="Heading 2",
 *   field_types={
 *     "string",
 *   }
 * )
 */
class Heading2 extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $element = array();

    foreach ($items as $delta => $item) {
      $element[$delta] = [
        '#type' => 'html_tag',
        '#tag' => 'h2',
        '#value' => $item->value,
        '#attributes' => [
          'id' => strtolower(Html::getUniqueId($item->value)),
        ],
      ];
    }

    return $element;
  }

}
