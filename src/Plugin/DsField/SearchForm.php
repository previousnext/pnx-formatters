<?php

namespace Drupal\pnx_formatters\Plugin\DsField;

use Drupal\ds\Plugin\DsField\DsFieldBase;
use Drupal\Core\Url;

/**
 * Plugin that renders the search form.
 *
 * @DsField(
 *   id = "search_form",
 *   title = @Translation("Search form"),
 *   entity_type = "node",
 *   provider = "node"
 * )
 */
class SearchForm extends DsFieldBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $form['#type'] = 'form';
    $form['#action'] = Url::fromRoute('view.search.page_1')->toString();
    $form['#method'] = 'get';

    $form['search'] = [
      '#type' => 'container',
      '#attributes' => [
        'class' => ['search__form'],
      ],
    ];

    $form['search']['name'] = [
      '#type' => 'search',
      '#title' => $this->t('Search'),
      '#title_display' => 'invisible',
      '#size' => 15,
      '#default_value' => '',
      '#attributes' => [
        'placeholder' => $this->t('Search the site...'),
        'class' => ['search__input'],
        'name' => 'name',
      ],
    ];

    $form['search']['actions'] = [
      '#type' => 'actions',
      '#attributes' => [
        'class' => ['search__button-wrapper'],
      ],
    ];

    $form['search']['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Search'),
      '#name' => '',
      '#attributes' => [
        'class' => ['search__button'],
      ],
    ];

    return $form;
  }

}
