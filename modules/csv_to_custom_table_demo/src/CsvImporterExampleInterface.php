<?php

namespace Drupal\csv_to_custom_table_demo;

interface CsvImporterExampleInterface {

  public function import(bool $truncate = false);

  public function importWithEvent(bool $truncate = false);

  public function truncateAll();
}
