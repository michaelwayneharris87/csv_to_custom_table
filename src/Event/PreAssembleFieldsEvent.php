<?php

namespace Drupal\csv_to_custom_table\Event;

use Drupal\Component\EventDispatcher\Event;

/**
 * The PreAssembleFieldse event.
 */
class PreAssembleFieldsEvent extends Event {

  /**
   * The name of the definition. Useful in checking for events.
   *
   * @var string
   */
  protected string $definitionName;

  /**
   * The data to be assembled before inserting into the database.
   *
   * @var array
   */
  protected array $data;

  /**
   * The column names of the table.
   *
   * @var array
   */
  protected array $columnNames;

  /**
   * The constructor for the class.
   *
   * @param string $definition_name
   *   The name of the definition.
   * @param array $data
   *   The data to be assembled before inserting into the database.
   * @param array $column_names
   *   The column names of the table.
   */
  public function __construct(string $definition_name, array $data, array $column_names) {
    $this->definition_name = $definition_name;
    $this->data = $data;
    $this->columnNames = $column_names;
  }

  /**
   * Returns the definition name.
   *
   * @return string
   *   The definition name.
   */
  public function getDefinitionName(): string {
    return $this->definition_name;
  }

  /**
   * Returns the data to be inserted into the table.
   *
   * @return array
   *   The data to be inserted into the table.
   */
  public function getData(): array {
    return $this->data;
  }

  /**
   * Sets the data to be inserted into the table.
   *
   * @param array $data
   *   The data to be inserted into the table.
   */
  public function setData(array $data): void {
    $this->data = $data;
  }

  /**
   * Returns the column names for the table into which data is inserted.
   *
   * @return array
   *   The column names for the table.
   */
  public function getColumnNames(): array {
    return $this->columnNames;
  }

  /**
   * Sets the column names for the table into which data is inserted.
   *
   * @param array $column_names
   *   The column names for the table.
   */
  public function setColumnNames(array $column_names): void {
    $this->columnNames = $column_names;
  }

}
