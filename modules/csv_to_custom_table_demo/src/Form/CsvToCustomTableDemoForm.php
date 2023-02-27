<?php

namespace Drupal\csv_to_custom_table_demo\Form;

use Drupal\Core\Database\Connection;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\csv_to_custom_table_demo\CsvImporterExampleInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Provides a CSV to custom table demo form.
 */
class CsvToCustomTableDemoForm extends FormBase {

  /**
   * The database connection.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $database;

  protected $exampleService;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database'),
      $container->get('csv_to_custom_table_demo.example')
    );
  }

  /**
   * Construct a form.
   *
   * @param \Drupal\Core\Database\Connection $database
   *   The database connection.
   */
  public function __construct(Connection $database, CsvImporterExampleInterface $exampleService) {
    $this->database = $database;
    $this->exampleService = $exampleService;
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'csv_to_custom_table_demo_csv_to_custom_table_demo';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['content'] = [
      '#type' => 'container',
      '#prefix' => '<div class="text-content">',
      '#postfix' => '</div>'
    ];

    $form['content']['basic_table'] = [
      '#type' => 'table',
      '#prefix' => '<b>' . $this->t('Basic CSV Importer Example Table (without using an event subscriber') . '</b>',
      '#header' => [
        $this->t('First Name'),
        $this->t('Last Name'),
        $this->t('Age'),
      ],
      '#empty' => $this->t('Sorry, There are no items!'),
    ];

    $basicRows = $this->getBasicExampleRows();
    $form['content']['basic_table']['#rows'] = $basicRows;

    $form['content']['separator'] = [
      '#type' => 'html_tag',
      '#tag' => 'hr',
    ];

    $form['content']['table_with_event'] = [
      '#type' => 'table',
      '#prefix' => '<b>' . $this->t('CSV Importer Example Table With Event (change data from csv to table using an event subscriber).') . '</b>',
      '#header' => [
        $this->t('Full Name'),
        $this->t('Age'),
      ],
      '#empty' => $this->t('Sorry, There are no items!'),
    ];

    $exampleWithEventRows = $this->getExampleWitheventRows();
    $form['content']['table_with_event']['#rows'] = $exampleWithEventRows;

    $form['content']['actions'] = [
      '#type' => 'actions',
    ];
    $form['content']['actions']['basic_import'] = [
      '#type' => 'submit',
      '#truncate' => false,
      '#value' => $this->t('Basic Example Import'),
      '#submit' => ['::basicImport'],
    ];
    $form['content']['actions']['basic_import_truncate'] = [
      '#type' => 'submit',
      '#truncate' => true,
      '#value' => $this->t('Basic Example Truncate then Import'),
      '#submit' => ['::basicImport'],
    ];
    $form['content']['actions']['import_with_event'] = [
      '#type' => 'submit',
      '#truncate' => false,
      '#value' => $this->t('With Event Example Import'),
      '#submit' => ['::importWithEvent'],
    ];
    $form['content']['actions']['import_with_event_truncate'] = [
      '#type' => 'submit',
      '#truncate' => true,
      '#value' => $this->t('With Event Example Truncate then Import'),
      '#submit' => ['::importWithEvent'],
    ];
    $form['content']['actions']['truncate_all'] = [
      '#type' => 'submit',
      '#value' => $this->t('Truncate All Demo Tables'),
      '#submit' => ['::truncateAll'],
    ];

    return $form;
  }
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // TODO: Implement submitForm() method.
  }

  public function basicImport(array &$form, FormStateInterface $form_state) {
    $truncate = $form_state->getTriggeringElement()['#truncate'];
    $this->exampleService->import($truncate);
  }

  public function importWithEvent(array &$form, FormStateInterface $form_state) {
    $truncate = $form_state->getTriggeringElement()['#truncate'];
    $this->exampleService->importWithEvent($truncate);
  }

  public function truncateAll() {
    $this->exampleService->truncateAll();
  }

  private function getBasicExampleRows() {
    $query = $this->database->query("SELECT firstname, lastname, age FROM {csv_to_custom_table_demo}");
    $result = $query->fetchAll();
    $rows = [];
    for ($i = 0; $i < count($result); $i++) {
      $rows[$i] = [
        'firstname' => [
          'data' => $result[$i]->firstname,
        ],
        'lastname' => [
          'data' => $result[$i]->lastname
        ],
        'age' => [
          'data' => $result[$i]->age,
        ],
      ];
    }
    return $rows;
  }

  private function getExampleWitheventRows() {
    $query = $this->database->query("SELECT fullname, age FROM {csv_to_custom_table_demo_with_event}");
    $result = $query->fetchAll();
    $rows = [];
    for ($i = 0; $i < count($result); $i++) {
      $rows[$i] = [
        'fullname' => [
          'data' => $result[$i]->fullname,
        ],
        'age' => [
          'data' => $result[$i]->age,
        ],
      ];
    }
    return $rows;
  }
}
