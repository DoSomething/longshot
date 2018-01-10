<?php

namespace App\Console\Commands;

use App\Models\Profile;
use Illuminate\Console\Command;

class GenerateTestData extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generate:testdata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make some test data';

    public function fire() {
        $profile = factory(Profile::class)->make();
        dd($profile);
    }
}
