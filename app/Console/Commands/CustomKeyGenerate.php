<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CustomKeyGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'key:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set the application key';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $key = $this->generateRandomKey();

        $this->setKeyInEnvironmentFile($key);

        $this->laravel['config']['app.key'] = $key;

        $this->info("Application key [$key] set successfully.");
    }

    /**
     * Set the application key in the environment file.
     *
     * @param  string $key
     * @return void
     */
    protected function setKeyInEnvironmentFile($key)
    {
        file_put_contents($this->laravel->environmentFilePath(), str_replace(
            'APP_KEY=' . $this->laravel['config']['app.key'],
            'APP_KEY=' . $key,
            file_get_contents($this->laravel->environmentFilePath())
        ));
    }

    /**
     * Generate a random key for the application.
     *
     * @return string
     */
    protected function generateRandomKey()
    {
        return str_replace('=', '', 'base64:' . base64_encode(random_bytes(
                $this->laravel['config']['app.cipher'] == 'AES-128-CBC' ? 16 : 32
            )));
    }
}
