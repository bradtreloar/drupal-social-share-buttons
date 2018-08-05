<?php

namespace Drupal\social_share_buttons\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'social_share_buttons_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
    $config = $this->config('social_share_buttons.settings');

    $form['show']['facebook'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Facebook'),
      '#default_value' => $config->get('social_share_buttons.facebook.show'),
    ];

    $form['show']['twitter'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Twitter'),
      '#default_value' => $config->get('social_share_buttons.twitter.show'),
    ];

    return $form;
  }

  
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('social_share_buttons.settings');

    $config->set('social_share_buttons.facebook.show', $form_state->getValue('facebook'));
    $config->set('social_share_buttons.twitter.show', $form_state->getValue('twitter'));
    $config->save();

    return parent::submitForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'social_share_buttons.settings',
    ];
  }

}