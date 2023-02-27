<?php

namespace Drupal\csv_to_custom_table;

use Drupal\csv_to_custom_table\CsvImportDefinition;
use Drupal\csv_to_custom_table\CsvImportDefinitionInterface;
use Drupal\csv_to_custom_table\CsvImportDefinitionBuilderInterface;

/**
 * Implements CsvImportBuilderInterface.
 */
class CsvImportDefinitionBuilder implements CsvImportDefinitionBuilderInterface {

  /**
   * The name of the import definition.
   *
   * @var string
   */
  protected string $name;

  /**
   * The path of the csv file.
   *
   * @var string
   */
  protected string $path;

  /**
   * The table name of the destination table.
   *
   * @var string
   */
  protected string $tableName;

  /**
   * The names of the columns in the destination table.
   *
   * @var array
   */
  protected array $columnNames;


  /**
   * TWhether to skip the first line of the csv.
   *
   * @var bool
   */
  protected bool $skipFirstLine = FALSE;

  /**
   * Whether to truncate the table priopr to improt.
   *
   * @var bool
   */
  protected bool $truncate = FALSE;

  /**
   * The csv escape character.
   *
   * @var bool
   */
  protected string $separator = ",";

  /**
   * The csv enclosure character.
   *
   * @var string
   */
  protected string $enclosure = "\"";

  /**
   * The csv escape character.
   *
   * @var string
   */
  protected string $escape = "\\";

  /**
   * The max line length parameter passed to fgetcsv.
   *
   * @var int|null
   */
  protected ?int $lineLength = NULL;

  /**
   * Set the name of the definition. Required. Chainable.
   */
  public function name(string $name): CsvImportDefinitionBuilderInterface {
    $this->name = $name;
    return $this;
  }

  /**
   * Set the path to the csv for the definition. Required. Chainable.
   */
  public function path(string $path): CsvImportDefinitionBuilderInterface {
    $this->path = $path;
    return $this;
  }

  /**
   * Set the table name for the definition. Required. Chainable.
   */
  public function tableName(string $table_name): CsvImportDefinitionBuilderInterface {
    $this->tableName = $table_name;
    return $this;
  }

  /**
   * Set the column names for the table definition. Required. Chainable.
   */
  public function columnNames(array $column_names): CsvImportDefinitionBuilderInterface {
    $this->columnNames = $column_names;
    return $this;
  }

  /**
   * Set whether to skip the first line of the csv. Optional. Chainable.
   */
  public function skipFirstLine(bool $skip_first_line = TRUE): CsvImportDefinitionBuilderInterface {
    $this->skipFirstLine = $skip_first_line;
    return $this;
  }

  /**
   * Set whether to truncate the table prior to import. Optional. Chainable.
   */
  public function truncate(bool $truncate = TRUE): CsvImportDefinitionBuilderInterface {
    $this->truncate = $truncate;
    return $this;
  }

  /**
   * Set the csv separator character. Optional. Chainable.
   */
  public function separator(string $separator): CsvImportDefinitionBuilderInterface {
    $this->separator = $separator;
    return $this;
  }

  /**
   * Set the csv enclosure character. Optional. Chainable.
   */
  public function enclosure(string $enclosure): CsvImportDefinitionBuilderInterface {
    $this->enclosure = $enclosure;
    return $this;
  }

  /**
   * Set the csv escape character. Optional. Chainable.
   */
  public function escape(string $escape): CsvImportDefinitionBuilderInterface {
    $this->escape = $escape;
    return $this;
  }

  /**
   * Set the max line length. Optional. Chainable.
   */
  public function lineLength(int $line_length): CsvImportDefinitionBuilderInterface {
    $this->lineLength = $line_length;
    return $this;
  }

  /**
   * Builds and returns the definition
   */
  public function build(): CsvImportDefinitionInterface {
    $definition = new CsvImportDefinition(
      $this->name,
      $this->path,
      $this->tableName,
      $this->columnNames
    );
    $definition->setSkipFirstLine($this->skipFirstLine);
    $definition->setTruncate($this->truncate);
    $definition->setSeparator($this->separator);
    $definition->setEnclosure($this->enclosure);
    $definition->setEscape($this->escape);
    $definition->setLineLength($this->lineLength);

    return $definition;
  }
}
