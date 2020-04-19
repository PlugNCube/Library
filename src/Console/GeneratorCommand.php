<?php
namespace Apply\Library\Console;

use Apply\Library\Engine;
use Apply\Library\Support\Str\Alias;
use Illuminate\Console\GeneratorCommand as Command;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

abstract class GeneratorCommand extends Command
{
    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return $this->getElement()->path(str_replace('\\', '/', 'src\\'.$name).'.php');
    }

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace()
    {
        return $this->getElement()->namespace()."\\";
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

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['element', 'e', InputOption::VALUE_OPTIONAL, 'Element library.'],
        ];
    }
}
