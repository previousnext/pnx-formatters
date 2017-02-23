<?php

namespace Drupal\pnx_formatters\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;
use Drupal\responsive_image\Plugin\Field\FieldFormatter\ResponsiveImageFormatter;

/**
 * Plugin for responsive image formatter w/ a link.
 *
 * @FieldFormatter(
 *   id = "responsive_image_with_link",
 *   label = @Translation("Responsive image (with link)"),
 *   field_types = {
 *     "image",
 *   }
 * )
 */
class LinkedResponsiveImageFormatter extends ResponsiveImageFormatter {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return parent::defaultSettings() + [
      'link_target_content' => '',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $elements = parent::settingsForm($form, $form_state);
    $elements['image_link']['#options']['link_target_content'] = $this->t('Other content');
    $elements['link_target_content'] = [
      '#type' => 'entity_autocomplete',
      '#target_type' => 'node',
      '#attributes' => [
        'data-autocomplete-first-character-blacklist' => '/#?',
      ],
      '#title' => $this->t('Content'),
      '#description' => $this->t('Content to link to.'),
      '#default_value' => $this->getSetting('link_target_content') ? Node::load($this->getSetting('link_target_content')) : NULL,
    ];
    $elements['#after_build'] = [get_class($this) . '::processState'];
    return $elements;
  }

  /**
   * Process callback to add state.
   */
  public static function processState($element, FormStateInterface $form_state, $form) {
    foreach (['link_target_content'] as $index) {
      $parents = $element[$index]['#parents'];
      $first = array_shift($parents);
      $self = array_pop($parents);
      $parents[] = 'image_link';
      $name = $first . '[' . implode('][', $parents) . ']';
      $element[$index]['#states'] = [
        'visible' => [
          ':input[name="' . $name . '"]' => ['value' => $self],
        ],
      ];
    }
    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = parent::settingsSummary();
    if ($this->getSetting('image_link') === 'link_target_content' && $nid = $this->getSetting('link_target_content')) {
      $summary[] = $this->t('Linking to: @entity', [
        '@uri' => Node::load($nid)->label(),
      ]);
    }
    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $build = parent::viewElements($items, $langcode);
    switch ($this->getSetting('image_link')) {
      case 'link_target_content':
        if ($node_id = $this->getSetting('link_target_content')) {
          $node = Node::load($node_id);
          $files = $this->getEntitiesToView($items, $langcode);
          foreach ($files as $delta => $file) {
            $build[$delta]['#url'] = $node->toUrl();
          }
        }
        break;
    }

    return $build;
  }

}
