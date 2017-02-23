<?php

namespace Drupal\pnx_formatters\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 * Formatter for displaying strings in an HTML list.
 *
 * @FieldFormatter(
 *   id="string_list",
 *   label="Text List",
 *   field_types={
 *     "string",
 *   }
 * )
 */
class StringList extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    return [
      [
        '#theme' => 'item_list',
        '#items' => array_column($items->getValue(), 'value'),
      ],
    ];
  }

}
