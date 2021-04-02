<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Hash;

class InsertProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comamdo para inserção de dados de produtos na base de dados';

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
    public function handle()
    {
        
        $input['name'] = $this->ask('Nome do produto:');
        $input['reference'] = $this->ask('Sua referencia:');
        $input['price'] = $this->ask('Seu preco:');
        $input['delivery_days'] = $this->ask('Sua entrega em dias:');

        Product::create($input);

        $this->info('Produto criado com sucesso!');

    }
}
