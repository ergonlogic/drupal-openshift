<?php

/**
 * @file
 * Contains \Drupal\system\Tests\Update\AutomatedCronUpdateWithoutAutomatedCronTest.
 */

namespace Drupal\system\Tests\Update;

/**
 * Ensures that the automated cron module is not installed on update.
 *
 * @group Update
 */
class AutomatedCronUpdateWithoutAutomatedCronTest extends UpdatePathTestBase {

  /**
   * {@inheritdoc}
   */
  protected function setDatabaseDumpFiles() {
    $this->databaseDumpFiles = [
      __DIR__ . '/../../../tests/fixtures/update/drupal-8.bare.standard.php.gz',
      __DIR__ . '/../../../tests/fixtures/update/drupal-8.without_automated_cron.php',
    ];
  }

  /**
   * Ensures that automated cron module isn't installed and the config migrated.
   */
  public function testUpdate() {
    $this->runUpdates();
    $module_data = \Drupal::config('core.extension')->get('module');
    $this->assertFalse(isset($module_data['automated_cron']), 'The automated cron module was not installed.');
  }

}
