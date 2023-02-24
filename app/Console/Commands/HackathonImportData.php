<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class HackathonImportData extends Command
{
    protected $type_classes = [
        'bigint' => \Doctrine\DBAL\Types\BigIntType::class,
        'string' => \Doctrine\DBAL\Types\StringType::class,
        'integer' => \Doctrine\DBAL\Types\IntegerType::class,
        'datetime' => \Doctrine\DBAL\Types\DateTimeType::class,
        'text' => \Doctrine\DBAL\Types\TextType::class
    ];

    protected $schema = [
        'animals' => [
            'id' => 'bigint',
            'image_id' => 'bigint',
            'owner_id' => 'bigint',
            'name' => 'string',
            'species' => 'string',
            'breed' => 'string',
            'age' => 'integer',
            'weight' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime'
        ],
        'images' => [
            'id' => 'bigint',
            'path' => 'string',
            'created_at' => 'datetime',
            'updated_at' => 'datetime'
        ],
        'owners' => [
            'id' => 'bigint',
            'first_name' => 'string',
            'surname' => 'string',
            'email' => 'string',
            'phone' => 'string',
            'address' => 'text',
            'created_at' => 'datetime',
            'updated_at' => 'datetime'
        ]
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hackathon:import-data'
        .' { --analyze : Analyze the tables first}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks the current database schema and if correct, imports data for the Laravel Hackathon';

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
     * @return int
     */
    public function handle()
    {
        if ($this->option('analyze')) {
            $this->analyzeTables();
        }

        $this->comment('Checking tables structure...');

        $table_names = array_map(function($table_result) {
            $row = (array)$table_result;
            return current($row);
        }, DB::select('SHOW TABLES'));

        $all_ok = true;

        foreach ($this->schema as $table => $schema_columns) {
            if (!in_array($table, $table_names)) {
                $this->error('Table `'.$table.'` not found in database.');
                $all_ok = false;
                continue;
            }

            $table_columns = Schema::getColumnListing($table);

            foreach ($schema_columns as $column => $column_type) {
                if (!in_array($column, $table_columns)) {
                    $this->error('Column `'.$column.'` not found on table `'.$table.'`.');
                    $all_ok = false;
                    continue;
                }

                $doctrine_column = DB::connection()->getDoctrineColumn($table, $column);

                $column_class = $this->type_classes[$column_type];

                if (!($doctrine_column->getType() instanceof $column_class)) {
                    $sample_type = new $column_class;
                    $this->error('Column `'.$column.'` on table `'.$table.'` must be of the type '.$sample_type->getName().'.');
                    $all_ok = false;
                }

                if ($column == 'id') {
                    if (!$doctrine_column->getAutoincrement()) {
                        $this->error('Column `id` on table `'.$table.'` is missing the AUTOINCREMENT feature');
                        $all_ok = false;
                    }
                }
            }

            $extra_columns = array_diff($table_columns, array_keys($schema_columns));
            foreach ($extra_columns as $extra_column) {
                $this->warn('Extra column `'.$extra_column.'` found on table `'.$table.'`');
            }

        }

        if ($all_ok) {
            $this->info('All tables ok!');

            $this->import();
        }

        return Command::SUCCESS;
    }

    public function analyzeTables()
    {
        $table_names = array_map(function($table_result) {
            $row = (array)$table_result;
            return current($row);
        }, DB::select('SHOW TABLES'));

        $unique_types = [];

        foreach ($table_names as $table) {
            $table_columns = Schema::getColumnListing($table);
            foreach ($table_columns as $column) {
                $doctrine_column = DB::connection()->getDoctrineColumn($table, $column);

                $unique_types[] = get_class($doctrine_column->getType());
            }
        }

        dd(array_unique($unique_types));
    }

    public function error($string, $verbosity = null)
    {
        return parent::error('ERROR:   '.$string, $verbosity);
    }

    public function warn($string, $verbosity = null)
    {
        return parent::warn('WARNING: '.$string, $verbosity);
    }

    public function import()
    {
        $this->comment('Truncating tables `animals`, `owners` and `images`...');

        DB::table('owners')->truncate();
        DB::table('animals')->truncate();
        DB::table('images')->truncate();

        $this->info('Tables truncated!');

        $this->comment('Importing data...');

        $data = json_decode(file_get_contents(storage_path('clients.json')));

        $animals = 0;
        $owners = 0;
        $images = 0;

        $now = date('Y-m-d H:i:s');

        foreach ($data as $owner_data) {
            DB::table('owners')->insert([
                'first_name' => $owner_data->first_name,
                'surname' => $owner_data->surname,
                'created_at' => $now,
                'updated_at' => $now
            ]);

            $owner_id = DB::getPdo()->lastInsertId();

            $owners++;

            if (!empty($owner_data->pets)) {
                foreach ($owner_data->pets as $pet_data) {

                    $image_id = null;
                    if (!empty($pet_data->photo)) {
                        DB::table('images')->insert([
                            'path' => $pet_data->photo,
                            'created_at' => $now,
                            'updated_at' => $now
                        ]);

                        $image_id = DB::getPdo()->lastInsertId();

                        $images++;
                    }

                    DB::table('animals')->insert([
                        'image_id' => $image_id,
                        'owner_id' => $owner_id,
                        'name' => $pet_data->name,
                        'species' => 'dog',
                        'breed' => $pet_data->breed,
                        'weight' => $pet_data->weight,
                        'age' => $pet_data->age,
                        'created_at' => $now,
                        'updated_at' => $now
                    ]);

                    $animal_id = DB::getPdo()->lastInsertId();

                    $animals++;
                }
            }
        }

        $this->info('Import successful!');
        $this->info("Inserted {$animals} animals, {$owners} owners and {$images} images");
    }
}
