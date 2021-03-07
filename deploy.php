<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'feednews');

// Project repository
set('repository', 'https://github.com/webstylecenter/feednews.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', [
    'storage'
]);

// Writable dirs by web server
add('writable_dirs', [
    'bootstrap/cache',
    'storage',
    'storage/app',
    'storage/app/public',
    'storage/framework',
    'storage/framework/cache',
    'storage/framework/sessions',
    'storage/framework/views',
    'storage/logs',
]);


// Hosts

host('vps01.petervdam.nl')
    ->user('peter')
    ->forwardAgent()
    ->stage('production')
    ->set('prefix', 'prod')
    ->set('deploy_path', '~/domains/feednews.me');

// Tasks

task('build', function () {
    set('deploy_path', __DIR__ . '/.build');
    invoke('deploy:unlock');
    invoke('deploy:info');
    invoke('deploy:prepare');
    invoke('deploy:lock');
    invoke('deploy:release');
    invoke('deploy:update_code');
    invoke('deploy:vendors');
    invoke('deploy:symlink');
    //run('cd {{release_path}} && build');
})->local();

task('release', [
    'deploy:info',
    'deploy:prepare',
    'deploy:release',
    'upload',
    'deploy:shared',
    'deploy:vendors',
    'update_database',
    'deploy:writable',
   // 'artisan:storage:link',
    'artisan:view:cache',
    'artisan:config:cache',
    'deploy:symlink',
    'deploy:unlock',
    'artisan:queue:restart',
]);

task('deploy', [
    'build',
    'release',
    'cleanup',
    'success'
]);

task('update_database', function () {
    run('{{bin/php}} {{release_path}}/artisan migrate --force');
})->desc('Update database schema');

task('upload', function () {
    upload(__DIR__ . "/.build/current/", '{{release_path}}');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

//before('deploy:symlink', 'artisan:migrate');

