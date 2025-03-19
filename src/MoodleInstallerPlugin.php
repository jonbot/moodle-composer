<?php

namespace Middag;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Installer\PackageEvent;
use Composer\Installer\PackageEvents;
use Composer\Plugin\PluginInterface;
use cweagans\Composer\PatchEvent;

class MoodleInstallerPlugin implements PluginInterface {
    public function activate(Composer $composer, IOInterface $io)
    {
        $this->composer = $composer;
        $this->io = $io;
    }

    public function deactivate(Composer $composer, IOInterface $io)
    {

    }

    public function uninstall(Composer $composer, IOInterface $io)
    {

    }

    public function getSubscribedEvents(): array
    {
        return array(
            PackageEvents::PRE_PACKAGE_INSTALL => ['onPrePackageInstall'],
            PatchEvents::POST_PATCH_APPLY => ['copyPatch'],
        );
    }

    public function copyPatch(PatchEvent $event): void
    {
        $patch = $event->getPatch();
        $target = $event->getTarget();
        $this->io->write("Copying patch {$patch->getPatch()} to {$target}");
        copy($patch->getPatch(), $target);
    }

    public function onPrePackageInstall(PackageEvent $event): void
    {
        $test = $event;
    }
}