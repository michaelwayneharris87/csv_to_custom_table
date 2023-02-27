<?php

namespace Drupal\csv_to_custom_table;

/**
 * CSVImport requires an instance of this interface to run an import.
 */
class CsvImportDefinition implements CsvImportDefinitionInterface {

  /**
   * The name of the definition.
   *
   * @var string
   */
  protected string $name;

  /**
   * The path to the csv to import.
   *
   * @var string
   */
  protected string $path;

  /**
   * The name of the table into which csv data will be imported.
   *
   * @var string
   */
  protected string $tableName;

  /**
   * An array of column names for $this->tableName.
   *
   * @var array
   */
  protected array $columnNames;


  /**
   * Whether to skip the first line of the source csv.
   *
   * @var bool
   */
  protected bool $skipFirstLine;

  /**
   * Whether to truncate the destination table before importing.
   *
   * @var bool
   */
  protected bool $truncate;

  /**
   * The separator used to parse the csv.
   *
   * @var string
   */
  protected string $separator;

  /**
   * The enclosure used to parse the csv.
   *
   * @var string
   */
  protected string $enclosure;

  /**
   * The escape character used to parse the csv.
   *
   * @var string
   */
  protected string $escape;

  /**
   * The maximum length of the line. See fgetcsv() for more info.
   *
   * @var int|null
   */
  protected ?int $lineLength;

  /**
   * The class constructor.
   */
  public function __construct(string $name, string $path, string $table_name, array $column_names) {
    $this->name = $name;
    $this->path = $path;
    $this->tableName = $table_name;
    $this->columnNames = $column_names;
  }

  /**
   * Returns the definition name. Useful for filtering on events.
   */
  public function getName(): string {
    return $this->name;
  }

  /**
   * Set the name of the definition. Useful for filtering on events.
   */
  public function setName(string $name): void {
    $this->name = $name;
  }

  /**
   * Return the path to the csv.
   */
  public function getPath(): string {
    return $this->path;
  }

  /**
   * Set the path to the csv.
   */
  public function setPath(string $path): void {
    $this->path = $path;
  }

  /**
   * Return the destination table name.
   */
  public function getTableName(): string {
    return $this->tableName;
  }

  /**
   * Set the destination table name.
   */
  public function setTableName(string $table_name): void {
    $this->tableName = $table_name;
  }

  /**
   * Return the names of the columns for the destination table.
   */
  public function getColumnNames(): array {
    return $this->columnNames;
  }

  /**
   * Set the names of the columns for the destination table.
   */
  public function setColumnNames(array $column_names): void {
    $this->columnNames = $column_names;
  }

  /**
   * Return whether to skip the first line of the csv.
   */
  public function getSkipFirstLine(): bool {
    return $this->skipFirstLine;
  }

  /**
   * Set whether to skip the first line of the csv.
   */
  public function setSkipFirstLine(bool $skip_first_line): void {
    $this->skipFirstLine = $skip_first_line;
  }

  /**
   * Return whether to truncate the table before importing.
   */
  public function getTruncate(): bool {
    return $this->truncate;
  }

  /**
   * Set whether to truncate the table before importing.
   */
  public function setTruncate(bool $truncate): void {
    $this->truncate = $truncate;
  }

  /**
   * Return the csv separator character.
   */
  public function getSeparator(): string {
    return $this->separator;
  }

  /**
   * Set the csv separator character.
   */
  public function setSeparator(string $separator): void {
    $this->separator = $separator;
  }

  /**
   * Return the csv enclosure character.
   */
  public function getEnclosure(): string {
    return $this->enclosure;
  }

  /**
   * Set the csv enclosure character.
   */
  public function setEnclosure(string $enclosure): void {
    $this->enclosure = $enclosure;
  }

  /**
   * Return the csv escape character.
   */
  public function getEscape(): string {
    return $this->escape;
  }

  /**
   * Set the csv escape character.
   */
  public function setEscape(string $escape): void {
    $this->escape = $escape;
  }

  /**
   * Return the maximum line length for fgetcsv.
   */
  public function getLineLength(): ?int {
    return $this->lineLength;
  }

  /**
   * Set the maximum line length for fgetcsv.
   */
  public function setLineLength(?int $line_length): void {
    $this->lineLength = $line_length;
  }

}
