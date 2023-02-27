<?php

namespace Drupal\csv_to_custom_table;

use Drupal\csv_to_custom_table\CsvImportDefinitionInterface;
use Drupal\csv_to_custom_table\CsvImportDefinitionBuilderInterface;

/**
 * Imports text delimited files into custom Drupal tables.
 *
 * If you can use the Migrate api instead, you should. This is a
 * fallback solution.
 */
interface CSVImporterInterface {

  /**
   * CSVImporter::import() requires a CsvImportDefinition.
   *
   * Generate it from this builder rather than using the
   * CsvImportDefinition::construct method.
   */
  public function definition(): CsvImportDefinitionBuilderInterface;

  /**
   * Runs the import defined in the Definition.
   */
  public function import(CsvImportDefinitionInterface $definition);

}
