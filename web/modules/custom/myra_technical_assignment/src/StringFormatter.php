<?php

namespace Drupal\myra_technical_assignment;

use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\myra_technical_assignment\Adder;

/**
 * Shows the a sentence describing two numbers added as TranslatableMarkup
 */
final class StringFormatter {

  /**
   * Constructs a StringFormatter object.
   */
  public function __construct(
    private readonly Adder $adder,
  ) {}

  /**
   * @param int $num1
   * @param int $num2
   * 
   * Calls the add() function of the Adder service if the values
   * entered are numeric, displays an error message otherwise.
   */
  public function showResults($num1, $num2): TranslatableMarkup {

    if (is_numeric($num1) && is_numeric($num2)) {
      if ($sum = $this->adder->add((float) $num1, (float) $num2)) {
        return t("The sum of %num1 and %num2 is %sum", [
          '%num1' => $num1,
          '%num2' => $num2,
          '%sum' => $sum,
        ]);
      }
    }

    return t("The numbers entered are invalid");

  }
}
