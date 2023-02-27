# CSV To Custom Table

This module provides two services to assist with importing text delimited files into custom Drupal tables.

## Requirements
No Special Requirements

## Use

###   csv_to_custom_table.importer

This class extracts data from a text delimited file and imports it into a specified table. The table must already exist
on the Drupal site; this module will not create the table.

If you can use a migration, you should. The Migrate module requires that each row of the source have a unique key.
If your CSV does not have a unique key, this service provides a fallback.

To run the import, first create a CsvImportDefinition object using CSVImporter::definition(). After building the
definition, execute the import using CSVImporter::import($definition).

### Events
We emit an event as part of the CSVImporter::import, before the fields are assembled into an array for inserting into
the database (\Drupal\csv_to_custom_table\Event\CSVImporterEvents::PRE_ASSEMBLE_FIELDS). This event can be used, for
example, to transform your data before it is inserted into the table.

As part of your CsvImportDefinition, provide a name that can be used to identify the import. Then, create an
EventSubscriber to listen for the event, and modify the data or the column names.

See \Drupal\csv_to_custom_table_demo\EventSubscriber\CsvToCustomTableDemoSubscriber for an example.
