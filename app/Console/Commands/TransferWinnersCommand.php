<?php

namespace App\Console\Commands;

use App\Models\Winner;
use Illuminate\Console\Command;

class TransferWinnersCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'transfer:winners';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Collect winners data and transfer to winners table.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        try {
            $users = (new Winner())->collectBiosForWinners();

            foreach ($users as $user) {
                $winner = Winner::where('user_id', $user->id)->firstOrFail();

                $winner->setUserData($user);

                $winner->save();
            }

            // Clear cache since scholarship winner's information was updated.
            $scholarship_ids = Scholarship::lists('id');
            array_unshift($scholarship_ids, 0);

            foreach ($scholarship_ids as $id) {
                Event::fire('data.update', ['winners', $id]);
            }

            $this->info('Transfer completed, have a scholarly beer!');
        } catch (Exception $error) {
            $this->error($error->getMessage());
        }
    }
}
