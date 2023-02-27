<?php

namespace Drupal\csv_to_custom_table;

use Drupal\Core\Database\Connection;
use Drupal\csv_to_custom_table\Event\CsvImporterEvents;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Drupal\csv_to_custom_table\Event\PreAssembleFieldsEvent;

/**
 * Imports text delimited files into custom Drupal tables.
 *
 * If you can use the Migrate api instead, you should. This is a
 * fallback solution.
 */
class CSVImporter implements CSVImporterInterface {


  /**
   * The database connection.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected Connection $connection;

  /**
   * The event dispatcher service.
   *
   * @var \Symfony\Contracts\EventDispatcher\EventDispatcherInterface
   */
  protected EventDispatcherInterface $eventDispatcher;

  /**
   * The constructor.
   */
  public function __construct(Connection $connection, EventDispatcherInterface $eventDispatcher) {
    $this->connection = $connection;
    $this->eventDispatcher = $eventDispatcher;
  }

  /**
   * CSVImporter::import() requires a CsvImportDefinition.
   *
   * Generate it from this builder rather than using the
   * CsvImportDefinition::construct method.
   */
  public function definition(): CsvImportDefinitionBuilderInterface {
    return new CsvImportDefinitionBuilder();
  }

  /**
   * Runs the import defined in the Definition.
   */
  public function import(CsvImportDefinitionInterface $definition) {
    $handle = fopen($definition->getPath(), 'r');
    $line_is_first_line = TRUE;
    if ($handle !== FALSE && $definition->getTruncate() == TRUE) {
      $this->connection->truncate($definition->getTableName())->execute();
    }
    while ($data = $this->fgetcsv($handle, $definition)) {
      if ($line_is_first_line && $definition->getSkipFirstLine() === TRUE) {
        $line_is_first_line = FALSE;
        continue;
      }
      $line_is_first_line = FALSE;

      if (empty($data[0])) {
        continue;
      }
      $data_to_inert = $this->assembleFields($definition->getName(), $data, $definition->getColumnNames());
      $this->insertRow($definition->getName(), $definition->getTableName(), $data_to_inert);
    }
  }

  /**
   * Insert the row into the database.
   *
   * @throws \Exception
   */
  public function insertRow(string $definition_name, string $table_name, array $data) {
    $this->connection->insert($table_name)->fields($data)->execute();
  }

  /**
   * Helps prepare the CSV row for insertion.
   */
  protected function assembleFields(string $name, array $data, array $column_names): array {
    $return_array = [];

    $event = new PreAssembleFieldsEvent($name, $data, $column_names);
    $this->eventDispatcher->dispatch($event, CSVImporterEvents::PRE_ASSEMBLE_FIELDS);
    $data = $event->getData();
    $column_names = $event->getColumnNames();
    foreach ($data as $index => $value) {
      $return_array[$column_names[$index]] = $value;
    }

    return $return_array;
  }

  /**
   * A wrapper around the php function fgetcsv.
   *
   * @param $handle
   *   The file handle from fopen()
   * @param \Drupal\csv_to_custom_table\CsvImportDefinitionInterface $definition
   *   The CsvImportDefinition, which contains values to pass to fgetcsv().
   *
   * @return array|false
   *   Returns the array if successful, false otherwise.
   */
  protected function fgetcsv(
    $handle,
    CsvImportDefinitionInterface $definition): bool|array {
    $line_length = $definition->getLineLength();
    $separator = $definition->getSeparator();
    $enclosure = $definition->getEnclosure();
    $escape = $definition->getEscape();

    return fgetcsv($handle, $line_length, $separator, $enclosure, $escape);
  }

}
