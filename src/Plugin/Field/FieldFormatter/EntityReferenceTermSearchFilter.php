<?php

namespace Drupal\pnx_formatters\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\Plugin\Field\FieldFormatter\EntityReferenceFormatterBase;
use Drupal\Core\Url;

/**
 * Plugin implementation of the 'Term Search Filter' formatter.
 *
 * @FieldFormatter(
 *   id = "entity_reference_term_search_filter",
 *   label = @Translation("Search term filter link"),
 *   description = @Translation("Display a term label linked to the search filter."),
 *   field_types = {
 *     "entity_reference"
 *   }
 * )
 */
class EntityReferenceTermSearchFilter extends EntityReferenceFormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = array();

    foreach ($this->getEntitiesToView($items, $langcode) as $delta => $entity) {
      $elements[$delta] = [
        '#type' => 'link',
        '#url' => Url::fromRoute('view.search.page_1'), // @todo make view configurable
        '#title' => $entity->label(),
        '#options' => [
          'query' => [
            'field_category_target_id' => $entity->id(), // @todo make field_id configurable
          ],
        ],
      ];
    }

    return [
      [
        '#theme' => 'item_list',
        '#items' => $elements,
        '#attributes' => [
          'class' => ['pills'],
        ],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public static function isApplicable(FieldDefinitionInterface $field_definition) {
    // This formatter is only available for taxonomy terms.
    return $field_definition->getFieldStorageDefinition()->getSetting('target_type') == 'taxonomy_term';
  }

}
