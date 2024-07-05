<?php

namespace Hivedrops\HiveConsent\Console\Commands;

use Illuminate\Console\Command;

class PublishConfig extends Command
{
    protected $signature = 'hive-consent:publish-config';
    protected $description = 'Publish Hive Consent configuration file';

    public function handle() {
        $this->call('vendor:publish', [
            '--tag' => 'config',
            '--force' => true,
        ]);

        $this->info('Successfully published config');
    }
}