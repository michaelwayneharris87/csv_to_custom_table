<?php

namespace Drupal\csv_to_custom_table;

/**
 * The builder for the CsvImportDefinition.
 *
 * The CSVImporter::import() function requires a CsvImportDefinition object, but
 * those objects should not be built directory with a constructor. Instead, use
 * the CsvImportDefinitionBuilder object (described here) from
 * CSVImporter::definition().
 *
 * The CsvImportDefinitionBuilder supports chaining. When all parameters have
 * been set, call build() to return the CsvImportDefinition from the builder.
 *
 * The CsvImportDefinitionBuilder should supply many defaults that are required
 * for the definition, optional for the builder.
 */
interface CsvImportDefinitionBuilderInterface
{

  /**
   * Set the name of the definition. Required. Chainable.
   */
  public function name(string $name): CsvImportDefinitionBuilderInterface;

  /**
   * Set the path to the csv for the definition. Required. Chainable.
   */
  public function path(string $path): CsvImportDefinitionBuilderInterface;

  /**
   * Set the table name for the definition. Required. Chainable.
   */
  public function tableName(string $table_name): CsvImportDefinitionBuilderInterface;

  /**
   * Set the column names for the table definition. Required. Chainable.
   */
  public function columnNames(array $column_names): CsvImportDefinitionBuilderInterface;

  /**
   * Set whether to skip the first line of the csv. Optional. Chainable.
   */
  public function skipFirstLine(bool $skip_first_line = TRUE): CsvImportDefinitionBuilderInterface;

  /**
   * Set whether to truncate the table prior to import. Optional. Chainable.
   */
  public function truncate(bool $truncate = TRUE): CsvImportDefinitionBuilderInterface;

  /**
   * Set the csv separator character. Optional. Chainable.
   */
  public function separator(string $separator): CsvImportDefinitionBuilderInterface;

  /**
   * Set the csv enclosure character. Optional. Chainable.
   */
  public function enclosure(string $enclosure): CsvImportDefinitionBuilderInterface;

  /**
   * Set the csv escape character. Optional. Chainable.
   */
  public function escape(string $escape): CsvImportDefinitionBuilderInterface;

  /**
   * Set the csv max line length. Optional. Chainable.
   */
  public function lineLength(int $length): CsvImportDefinitionBuilderInterface;

  /**
   * Builds and returns the definition.
   */
  public function build(): CsvImportDefinitionInterface;

}
