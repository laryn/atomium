<?php

namespace Drupal\atomium\TaskRunner\Commands;

use EC\OpenEuropa\TaskRunner\Commands\BaseCommands;

/**
 * Class VisualRegressionCommands.
 *
 * @package My\Custom\TaskRunner\Commands
 */
class VisualRegressionCommands extends BaseCommands {

  /**
   * Test command.
   *
   * @command atomium:build-reference
   */
  public function buildReference() {
    $collection = $this->collectionBuilder();

    $collection->addTaskList([
      $this->taskFilesystemStack()->remove('tests/reference'),
      $this->taskGitStack()->cloneShallow('https://github.com/ec-europa/atomium.git', 'tests/reference'),
      $this->taskComposerInstall()->workingDir('./tests/reference'),
      $this->taskExec('./vendor/bin/run dsi --root=tests/reference/build --database-name=reference'),
    ]);

    return $collection;
  }

}
