<?php
declare(strict_types=1);

namespace RayaFort\Subscriptions\Console\Commands;

use Illuminate\Console\Command;

class PublishCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rayafort:publish:subscriptions {--force : Overwrite any existing files.} {--R|resource=all}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish Subscriptions Resources.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->alert($this->description);

        switch ($this->option('resource')) {
            case 'config':
                $this->call('vendor:publish', ['--tag' => 'rayafort-subscriptions-config', '--force' => $this->option('force')]);
                break;
            case 'migrations':
                $this->call('vendor:publish', ['--tag' => 'rayafort-subscriptions-migrations', '--force' => $this->option('force')]);
                break;
            default:
                $this->call('vendor:publish', ['--tag' => 'rayafort-subscriptions-config', '--force' => $this->option('force')]);
                $this->call('vendor:publish', ['--tag' => 'rayafort-subscriptions-migrations', '--force' => $this->option('force')]);
                break;
        }

        $this->line('');
    }
}
