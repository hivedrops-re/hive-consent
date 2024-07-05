<?php

namespace Hivedrops\HiveConsent\Console\Commands;

use Illuminate\Console\Command;

class PublishLang extends Command
{
    protected $signature = 'hive-consent:publish-lang';
    protected $description = 'Publish Hive Consent languages files';

    public function handle() {
        $this->call('vendor:publish', [
            '--tag' => 'lang',
            '--force' => true,
        ]);

        $this->info('Successfully published languages files');
    }
}