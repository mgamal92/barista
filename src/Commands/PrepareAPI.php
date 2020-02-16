<?php

namespace Barista\Commands;

use Barista\Builder;
use Barista\Parser;
use Illuminate\Console\Command;

class PrepareAPI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prepare:api {file=api.json : API Input File}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prepare your api with docs';

    /**
     * @var Builder
     */
    private $builder;

    /**
     * @var Parser
     */
    private $parser;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Builder $builder, Parser $parser)
    {
        parent::__construct();

        $this->builder = $builder;
        $this->parser = $parser;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $file = $this->argument('file');

        $tree = $this->parser->getContent(__DIR__.'/../../../../../'.$file);

        $this->builder->prepare($tree);

        $this->builder->generateModels();

        $this->builder->generateMigrations();

        // echo "\n";
        // $this->builder->generateFactory();

        // echo "\n";
        // $this->builder->generateControllers();

        // echo "\n";
        // $this->builder->generateRoutes();
        
        $this->info('The API endpoints has been generated sucessfully!');
    }
}
