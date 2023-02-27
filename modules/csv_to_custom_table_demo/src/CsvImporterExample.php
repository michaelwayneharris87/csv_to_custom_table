<?php

namespace Drupal\csv_to_custom_table_demo;

use Drupal\csv_to_custom_table\CSVImporterInterface;
use Drupal\csv_to_custom_table_demo\CsvImporterExampleInterface;
use Drupal\Core\Extension\ModuleExtensionList;
use Drupal\Core\Database\Connection;

/**
 * Service description.
 */
class CsvImporterExample implements CsvImporterExampleInterface {

  /**
   * The csv_to_custom_table.importer service.
   *
   * @var \Drupal\csv_to_custom_table\CSVImporterInterface
   */
  protected $importer;

  /**
   * @var ModuleExtensionList
   */
  protected $moduleExtensionList;

  protected $database;

  /**
   * Constructs an Example object.
   *
   * @param \Drupal\csv_to_custom_table\CSVImporterInterface $importer
   *   The csv_to_custom_table.importer service.
   */
  public function __construct(
    CSVImporterInterface $importer,
    ModuleExtensionList $moduleExtensionList,
    Connection $database
  ) {
    $this->importer = $importer;
    $this->moduleExtensionList = $moduleExtensionList;
    $this->database = $database;
  }

  /**
   * Method description.
   */
  public function import(bool $truncate = false) {
    $importDefinition = $this->importer->definition()
      ->name('basic_import')
      ->path($this->moduleExtensionList->getPath('csv_to_custom_table_demo') . '/data.tsv')
      ->tableName('csv_to_custom_table_demo')
      ->columnNames(['firstname', 'lastname', 'age'])
      ->separator("\t")
      ->truncate($truncate)
      ->build();
    $this->importer->import($importDefinition);
  }

  /**
   * Method description.
   */
  public function importWithEvent(bool $truncate = false) {
    $importDefinition = $this->importer->definition()
      ->name('import_with_event')
      ->path($this->moduleExtensionList->getPath('csv_to_custom_table_demo') . '/data.tsv')
      ->tableName('csv_to_custom_table_demo_with_event')
      ->columnNames(['fullname', 'age'])
      ->separator("\t")
      ->truncate($truncate)
      ->build();
    $this->importer->import($importDefinition);
  }

  public function truncateAll() {
    $this->database->truncate('csv_to_custom_table_demo')->execute();
    $this->database->truncate('csv_to_custom_table_demo_with_event')->execute();
  }

}
