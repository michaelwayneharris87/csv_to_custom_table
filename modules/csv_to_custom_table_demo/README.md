# CSV To Custom Table Demo

This module provides a demo for the csv_to_custom_table module.

The csv_to_custom_table module provides a helper service to insert data from a text delimited file into a custom Drupal
table. If you can use a migration for these purposes, you should. But, migrations require that each row in the source
have a unique key. If your csv does not have a unique key, you need another solution, such as the csv_to_custom_table
module.

In this demo, we provide one text delimited file (data.tsv). We also provide two custom tables (csv_to_custom_table_demo
and csv_to_custom_table_demo_with_event). We insert the data from the tsv into each table. Because the umber of columns
in the data.tsv file and the number of columns in the csv_to_custom_table_demo_with_event are different, we transform
the data with an event subscriber emmitted by the csv_to_custom_table.importer service.

See /csv-to-custom-table-demo for a demonstration.
