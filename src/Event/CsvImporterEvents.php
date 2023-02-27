<?php

namespace Drupal\csv_to_custom_table\Event;

/**
 * Events fired by the CSVImporter service.
 */
final class CsvImporterEvents {


  /**
   * The event fired immediately before fields are assembled.
   *
   * Use this event to modify data before it is assembled as part of the
   * csv_to_custom_table.importer service.
   *
   * @Event
   *
   * @see \Drupal\csv_to_custom_table\Event\PreAssembleFieldsEvent
   *
   * @var string
   */
  const PRE_ASSEMBLE_FIELDS = 'csv_to_custom_table.pre_assemble_fields';

}
