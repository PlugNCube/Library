<?php

namespace Apply\Library\Console\Commands;

use Illuminate\Console\Command;

class LibraryList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'library:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all element Library';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->table(['Name', 'Driver', 'alias', 'Status', 'Core', 'Path'], $this->getRows());
    }

    /**
     * Get table rows.
     *
     * @return array
     */
    public function getRows()
    {
        $rows = [];

        foreach (library()->element()->read() as $package) {
            $rows[] = [
                $package->name,
                $package->driver(),
                $package->alias,
                $package->active ? 'Enabled' : 'Disabled',
                $package->core ? 'true' : 'false',
                $package->path(),
            ];
        }
        return $rows;
    }

}
