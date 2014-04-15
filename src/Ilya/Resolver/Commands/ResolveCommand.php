<?php namespace Ilya\Resolver\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Ilya\Resolver\Resolver;

class ResolveCommand extends Command {

    /**
     * The name of the command
     *
     * @var string
     */
    protected $name = 'facade:resolve';

    /**
     * The command description
     *
     * @var string
     */
    protected $description = 'Show underlying classes and the corresponding IoC bindings';

    /**
     * The Resolver instance
     *
     * @var \Ilya\Resolver\Resolver
     */
    protected $resolver;

    /**
     * The TableHelper instance
     *
     * @var \Symfony\Component\Console\Helper\TableHelper
     */
    protected $table;

    /**
     * The constructor
     *
     * @param \Ilya\Resolver\Resolver $resolver
     * @return void
     */
    public function __construct(Resolver $resolver)
    {
        parent::__construct();

        $this->resolver = $resolver;
    }

    /**
     * Execute the command
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
     * Display the data
     *
     * @param array $data
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
     * Get the arguments list
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

