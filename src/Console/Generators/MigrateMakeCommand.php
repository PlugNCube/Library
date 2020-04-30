<?php

namespace Apply\Library\Console\Generators;

use Apply\Library\Support\Str\Alias;
use Illuminate\Console\Command;

class MigrateMakeCommand extends Command
{
    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'library:make:migration {name : The name of the migration}
        {--create= : The table to be created}
        {--table= : The table to migrate}
        {--element= : Element library.}
        {--path= : The location where the migration file should be created}
        {--realpath : Indicate any provided migration file paths are pre-resolved absolute paths}
        {--fullpath : Output the full path of the migration}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new migration file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $arguments = $this->argument();

        $element = $this->getElement();

        $option = $this->option();
        $options = [];

        array_walk($option, function (&$value, $key) use (&$options) {
            $options['--' . $key] = $value;
        });

        unset($options['--path']);
        unset($options['--element']);

        $options['--path'] = $element->strPath('database/migrations');
        $options['--path'] = ltrim($options['--path'], '/');
        return $this->call('make:migration', array_merge($arguments, $options));
    }

    /**
     * Get the element library.
     *
     * @return mixed
     */
    protected function getElement()
    {
        $element = $this->option('element');
        $alias = Alias::render($element);
        return  library()->cube($alias::cube())->where('name',$alias::plug())->first();
    }
}
