<?php

namespace Hivedrops\HiveConsent\Console\Commands;

use Illuminate\Console\Command;

class PublishViews extends Command
{
    protected $signature = 'hive-consent:publish-views';
    protected $description = 'Publish Hive Consent views';

    public function handle() {
        $this->call('vendor:publish', [
            '--tag' => 'hive-consent',
            '--force' => true,
        ]);

        $this->info('Successfully published views');
    }
}