<?php 

namespace Drupal\myra_technical_assignment\Form;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\ReplaceCommand;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\myra_technical_assignment\StringFormatter;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a Myra Technical Assignment form.
 */
final class AdderForm extends FormBase {

    /**
   * @var \Drupal\myra_technical_assignment\StringFormatter $string_formatter
   */
  protected $string_formatter;

  /**
   * @param \Drupal\myra_technical_assignment\StringFormatter $string_formatter
   */
  public function __construct(StringFormatter $string_formatter) {
    $this->string_formatter = $string_formatter;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    // Instantiates this form class.
    return new static(
      // Load the service required to construct this class.
      $container->get('myra_technical_assigment.string_formatter')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'myra_technical_assignment_adder';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {

    $form['num1'] = [
      '#type' => 'textfield',
      '#attributes' => [
        'pattern' => '[0-9]*'
      ],
      '#title' => t('First Number'),
      '#ajax' => [
        'event' => 'change',
        'wrapper' => 'adder-result',
        'callback' => '::callback',
      ]
    ];

    $form['num2'] = [
      '#type' => 'textfield',
      '#attributes' => [
        'pattern' => '[0-9]*'
      ],
      '#title' => t('Second Number'),
      '#ajax' => [
        'event' => 'change',
        'wrapper' => 'adder-result',
        'callback' => '::callback',
      ]
    ];

    $form['result'] = [
      '#type' => 'item',
      '#markup' => '',
      '#prefix' => '<div id="adder-result">',
      '#suffix' => '</div',
    ];
    
    return $form;
  }

  // AJAX Callback to show the form results as Translatable Markup
  public function callback($form, $form_state) {

    $ajax_response = new AjaxResponse;

      $num1 = $form_state->getValue('num1') ?: "0";
      $num2 = $form_state->getValue('num2') ?: "0";
      $form['result']['#markup'] = $this->string_formatter->showResults($num1, $num2);
      $ajax_response->addCommand(new ReplaceCommand('#adder-result', $form['result']));

    return $ajax_response;

  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state): void {
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {
  }

}
