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
   * Build reference site.
   *
   * @command atomium:build-reference
   */
  public function buildReference() {
    $collection = $this->collectionBuilder();
    $directory = $this->getConfig()->get('atomium.reference.root');
    $repository = $this->getConfig()->get('atomium.repository');

    $collection->addTaskList([
      $this->taskFilesystemStack()->remove($directory),
      $this->taskGitStack()->cloneShallow($repository, $directory),
      $this->taskComposerInstall()->workingDir($directory),
    ]);

    return $collection;
  }

  /**
   * Install reference site.
   *
   * @command atomium:install-reference
   */
  public function installReference() {
    return $this->taskExec('./vendor/bin/run dsi --root=tests/reference/build --database-name=reference');
  }

}
