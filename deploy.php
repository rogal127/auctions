<?php
namespace Deployer;

require 'recipe/common.php';
set('keep_releases', 1);
set('writable_use_sudo', false);
set('writable_mode', 'chown');
// Project name
set('application', 'SzlachetneInwestycje');

// Project repository
set('repository', 'git@github.com:rogal127/auctions.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
set('shared_files', [
    '.env'
]);
set('shared_dirs', [
    'storage',
    'public/images',
]);

// Writable dirs by web server 
set('writable_dirs', [
    'bootstrap/cache',
    'storage',
    'storage/app',
    'storage/app/public',
    'storage/framework',
    'storage/framework/cache',
    'storage/framework/sessions',
    'storage/framework/views',
    'storage/logs',
    'public/images',
    'public/images/clients_photos',
    'public/images/clients',
    'public/images/articles',
    'public/images/portfolio',
    'public/images/team',
]);

// Hosts

host('rogal127.smarthost.pl')
    ->user('rogal127')
    ->port('5739')
    ->set('http_user', 'rogal127')
    ->set('branch', 'main')
    ->stage('production')
    ->set('deploy_path', '/home/rogal127/public_html/hot-task-api.pl');
    
/*host('rogal127.smarthost.pl')
    ->user('rogal127')
    ->port('5739')
    ->set('http_user', 'rogal127')
    ->set('branch', 'master')
    ->stage('staging')
    ->set('deploy_path', '/home/rogal127/public_html/staging_szlachetneinwestycje.pl');*/

// Tasks

desc('Deploy your project');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:copy_dirs',
    'deploy:writable',
    //'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);

desc('Copy directories');
task('deploy:copy_dirs', function () {
    if (has('previous_release')) {
        foreach (get('copy_dirs') as $dir) {
            if (test("[ -d {{previous_release}}/$dir ]")) {
                run("mkdir -p {{release_path}}/$dir");
                run("rsync -av {{previous_release}}/$dir/ {{release_path}}/$dir");
            }
        }
    }
});

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');