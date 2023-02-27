<?php

namespace Drupal\csv_to_custom_table;

/**
 * The interface for the csv_to_custom_table.importer definition.
 *
 * The csv_to_custom_table.importer service expects an instance of thie interface to
 * perform the csv import. The CsvImportDefinition provides all information
 * necessary to read the csv (see
 * https://www.php.net/manual/en/function.fgetcsv.php) and
 * all information necessary to insert the data into the database.
 *
 * The $name property of the CsvImportDefinition allows EventSubscribers to
 * distinguish between imports.
 *
 * You should NEVER generate a CsvImportDefinition via the constructor. Instead,
 * use the builder class provided by CsvImporter::definition(). See
 * Drupal\csv_to_custom_table\CsvImportDefinitionBuilder for more information.
 */
interface CsvImportDefinitionInterface {

  /**
   * The class constructor.
   */
  public function __construct(
    string $name,
    string $path,
    string $table_name,
    array $column_names,
  );

  /**
   * Returns the definition name. Useful for filtering on events.
   */
  public function getName(): string;

  /**
   * Set the name of the definition. Useful for filtering on events.
   */
  public function setName(string $name);

  /**
   * Return the path to the csv.
   */
  public function getPath(): string;

  /**
   * Set the path to the csv.
   */
  public function setpath(string $path);

  /**
   * Return the destination table name.
   */
  public function getTableName(): string;

  /**
   * Set the destination table name.
   */
  public function setTableName(string $name);

  /**
   * Return the names of the columns for the destination table.
   */
  public function getColumnNames(): array;

  /**
   * Set the names of the columns for the destination table.
   */
  public function setColumnNames(array $names);

  /**
   * Return whether to skip the first line of the csv.
   */
  public function getSkipFirstLine(): bool;

  /**
   * Set whether to return the first line of the csv.
   */
  public function setSkipFirstLine(bool $skip_first_line);

  /**
   * Return whether to truncate the table before importing.
   */
  public function getTruncate(): bool;

  /**
   * Set whether to truncate the table before importing.
   */
  public function setTruncate(bool $truncate);

  /**
   * Return the separator character.
   */
  public function getSeparator(): string;

  /**
   * Set the separator character.
   */
  public function setSeparator(string $separator);

  /**
   * Return the csv enclosure character.
   */
  public function getEnclosure(): string;

  /**
   * Set the csv enclosure character.
   */
  public function setEnclosure(string $enclosure);

  /**
   * Return the csv escape character.
   */
  public function getEscape(): string;

  /**
   * Set the csv escape character.
   */
  public function setEscape(string $escape);

  /**
   * Return the maximum line length for fgetcsv.
   */
  public function getLineLength(): ?int;

  /**
   * Set the maximum line length for fgetcsv.
   */
  public function setLineLength(int $line_length);

}
