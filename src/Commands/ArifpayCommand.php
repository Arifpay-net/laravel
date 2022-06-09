<?php

namespace Arifpay\Arifpay\Commands;

use Illuminate\Console\Command;

class ArifpayCommand extends Command
{
    public $signature = 'arifpay';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
