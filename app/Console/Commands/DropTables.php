<?php namespace App\Console\Commands;

use DB;
use Illuminate\Console\Command;

class DropTables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'drop-tables {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * DropTables constructor.
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
        if (!$this->option('force')) {
            if (!$this->confirm('Confirm drop all tables? Note this will create a database backup first')) {
                exit('Drop Tables command aborted'.PHP_EOL);
            }
        }

        $exitCode = $this->call('backup:run', ['--only-db' => true]);
        if ($exitCode !== 0) {
            exit('Error taking database backup');
        }

        $colname = 'Tables_in_' . env('DB_DATABASE');

        $tables = DB::select('SHOW TABLES');

        $droplist = [];
        foreach($tables as $table) {
            $droplist[] = $table->$colname;
        }

        if ($droplist) {
            $droplist = implode(',', $droplist);

            DB::beginTransaction();
            DB::statement('SET FOREIGN_KEY_CHECKS = 0');
            DB::statement("DROP TABLE $droplist");
            DB::statement('SET FOREIGN_KEY_CHECKS = 1');
            DB::commit();

            $this->comment(PHP_EOL."If no errors showed up, all tables were dropped.".PHP_EOL);
        } else {
            $this->comment(PHP_EOL."No tables found to drop.".PHP_EOL);
        }

    }
}
