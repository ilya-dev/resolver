<?php namespace Ilya\Resolver\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

use Ilya\Resolver\Resolver;

class ResolveCommand extends Command {

    /**
     * Name
     *
     * @var string
     */
    protected $name = 'facade:resolve';

    /**
     * Description
     *
     * @var string
     */
    protected $description = 'Show underlying class and corresponding IoC binding';

    /**
     * Resolver instance
     *
     * @var \Ilya\Resolver\Resolver
     */
    protected $resolver;

    /**
     * Table helper instance
     *
     * @var \Symfony\Component\Console\Helper\TableHelper
     */
    protected $table;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct(Resolver $resolver)
    {
        parent::__construct();

        $this->resolver = $resolver;
    }

    /**
     * Fire
     *
     * @return void
     */
    public function fire()
    {
        $this->table = $this->getHelperSet()->get('table');

        $query = $this->argument('query');

        $this->display($this->resolver->resolve($query));
    }

    /**
     * Display given data
     *
     * @return void
     */
    protected function display(array $data)
    {
        $table = $this->table;

        $table->setHeaders(['Facade', 'Class', 'IoC binding']);
        $table->setRows($data);

        $table->render($this->getOutput());
    }

    /**
     * Arguments
     *
     * @return array
     */
    public function getArguments()
    {
        return [
            ['query', InputArgument::OPTIONAL, 'Query string', '*'],
        ];
    }

}
