<?php 

namespace Drupal\myra_technical_assignment\Controller;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Form\FormBuilderInterface;

/**
 * Returns responses for Myra Technical Assignment routes.
 */
final class MyraTechnicalAssignmentController extends ControllerBase {

  /**
   * The controller constructor.
   */
  public function __construct(
    private readonly FormBuilderInterface $form_builder,
    ) {}

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container): self {
    return new self(
      $container->get('form_builder'),
    );
  }

  /**
   * Builds the response.
   */
  public function __invoke(): array {

    $build['description'] = [
      '#type' => 'item',
      '#markup' => t("Enter any two numbers and press enter to see the results"),
    ];
    
    $build['form'] = $this->form_builder->getForm('Drupal\myra_technical_assignment\Form\AdderForm');

    return $build;
  }

}
