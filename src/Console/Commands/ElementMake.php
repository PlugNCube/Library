<?php

namespace Apply\Library\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class ElementMake extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:element {name} {--type=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Element';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $cube = $this->option('type') ?? 'plug';

        $module = library()->generate($this->argument('name'), $cube);

        if ($module['status'] == 'error')
            $this->error($module['message']);

        elseif($module['status'] == 'success')
            $this->info($module['message']);
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['type', 't', InputOption::VALUE_OPTIONAL, 'Generate a resource element for the given library.'],
        ];
    }
}
