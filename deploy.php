<?php
namespace Deployer;

require 'recipe/laravel.php';

set('ssh_type', 'native');
set('ssh_multiplexing', true);

set('repository', 'https://github.com/webstylecenter/feednews.git');

set('current_path', '{{deploy_path}}/release');

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', ['storage']);
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
host('prod.vps01.petervdam.nl')
    ->user('peter')
    ->forwardAgent()
    ->stage('production')
    ->set('prefix', 'prod')
    ->set('domain', 'https://feednews.me')
    ->set('deploy_path', '/home/peter/domains/feednews.me');

task('build', function () {
    set('deploy_path', __DIR__ . '/.build');
    invoke('deploy:unlock');
    invoke('deploy:info');
    invoke('deploy:prepare');
    invoke('deploy:release');
    invoke('deploy:update_code');
    invoke('deploy:vendors');
    invoke('deploy:symlink');
})->local();

task('release', [
    'deploy:info',
    'deploy:prepare',
    'upload',
   // 'copy_env',
    'deploy:vendors',
    'artisan:migrate',
    'artisan:storage:link',
    'artisan:view:cache',
    'artisan:config:cache',
    'deploy:symlink',
    'clear_opcache',
]);

task('deploy', [
    'build',
    'release',
    'cleanup',
    'success',
]);

// Tasks
task('upload', function () {
    upload(__DIR__ . '/.build/current/', '{{release_path}}');
});

task('clear_opcache', function () {
    run('curl {{domain}}/clear-opcache.php?PcaW1KQ3GCeaK32kY7t1PI1Tn9iCkMzG -v');
});

//task('copy_env', function () {
//    run('/usr/bin/cp -rf {{release_path}}/.env_prod  {{release_path}}/.env');
//});
