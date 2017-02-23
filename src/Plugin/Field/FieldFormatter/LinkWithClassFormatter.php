<?php

namespace Drupal\pnx_formatters\Plugin\Field\FieldFormatter;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\link\Plugin\Field\FieldFormatter\LinkFormatter;

/**
 * Plugin implementation of the 'link' formatter with a class.
 *
 * @FieldFormatter(
 *   id = "link_class",
 *   label = @Translation("Link with optional class"),
 *   field_types = {
 *     "link"
 *   }
 * )
 */
class LinkWithClassFormatter extends LinkFormatter {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return parent::defaultSettings() + ['class' => ''];
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $elements = parent::settingsForm($form, $form_state);
    $elements['class'] = [
      '#type' => 'textfield',
      '#default_value' => $this->getSetting('class'),
      '#title' => $this->t('Link class'),
      '#maxlength' => 50,
    ];
    return $elements;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = parent::settingsSummary();
    if ($class = $this->getSetting('class')) {
      $summary[] = $this->t('With class @class', ['@class' => $class]);
    }
    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = parent::viewElements($items, $langcode);
    if ($class = $this->getSetting('class')) {
      foreach ($elements as $delta => $element) {
        $elements[$delta]['#options']['attributes']['class'][] = $class;
      }
    }
    return $elements;
  }

}
