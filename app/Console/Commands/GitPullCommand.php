<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class GitPullCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'git:pull';

    /**
     * The console command description.
     *
     * @var string
     */

    protected $description = 'Pull latest changes from GitHub repository';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $repoPath = base_path(); // Папка с проектом Laravel

        // Выполняем команду git pull
        $output = shell_exec("cd {$repoPath} && git pull origin master 2>&1");

        // Записываем лог
        Log::info('Git Pull Output: ' . $output);

        $this->info("Git pull executed successfully!");
    }
}
