<?php

namespace Drupal\csv_to_custom_table_demo\EventSubscriber;


use Drupal\csv_to_custom_table\Event\CsvImporterEvents;
use Drupal\csv_to_custom_table\Event\PreAssembleFieldsEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\migrate\Event\MigratePostRowSaveEvent;
use Drupal\migrate\Event\MigrateEvents;
use Drupal\migrate\Event\MigrateImportEvent;

class CsvToCustomTableDemoSubscriber implements EventSubscriberInterface {

  /**
   * @return array
   */
  public static function getSubscribedEvents() {
    return [
      CsvImporterEvents::PRE_ASSEMBLE_FIELDS => ['onPreAssembleFields'],
    ];
  }

  public function onPreAssembleFields(PreAssembleFieldsEvent $event) {
    if ($event->getDefinitionName() == 'import_with_event') {
      $data = $event->getData();
      $newdata = [];
      $newdata[] = $data[1] . ', ' . $data[0];
      $newdata[] = $data[2];
      $event->setData($newdata);
    }
  }

}
