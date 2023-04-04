<?php
namespace Deployer;

require 'recipe/common.php';

set('application', 'starter-wordpress');
set('repository', 'git@github.com:trendwerk/starter-wordpress.git');

set('host', '');
set('user', '');
set('port', 22);
set('path', '/var/www/vhosts/{{user}}/site');

set('remote_url', 'https://www.starter-wordpress.com');
set('local_url', 'https://www.starter-wordpress.test');

set('shared_dirs', ['web/app/uploads']);
set('shared_files', ['.env']);

host(get('host'))
    ->stage('production')
    ->user(get('user'))
    ->port(get('port'))
    ->set('deploy_path', get('path'));

// Deploy
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'clear:opcache',
    'cleanup',
    'success'
]);

task('clear:opcache', function () {
    run('php-fpm-cli -r "opcache_reset();"');
});

after('deploy:failed', 'deploy:unlock');

// SSH into remote server
task('ssh', function () {
    runLocally('ssh {{user}}@{{host}} -p{{port}}');
});

// Pull database
task('db:pull', function () {
    runLocally('wp db export -> db.sql --ssh={{user}}@{{host}}:{{port}}{{path}}/current/web');
    runLocally('wp db import db.sql');
    runLocally('rm -f db.sql');
    runLocally('wp search-replace {{remote_url}} {{local_url}} --skip-columns=guid');
    runLocally('wp plugin deactivate limit-login-attempts varnish-http-purge');
});

// Push database
task('db:push', function () {
    $sure = askConfirmation("Are you sure you want to overwite the remote database?", false);
    if (!$sure) { die('Task aborted.'); }

    runLocally('wp db export db.sql');
    runLocally('scp -P {{port}} db.sql {{user}}@{{host}}:{{path}}/current/web');
    run('cd {{path}}/current/web && wp db import db.sql');
    run('cd {{path}}/current/web && wp search-replace {{local_url}} {{remote_url}} --skip-columns=guid');
    runLocally('rm -f db.sql');
});

// Pull uploads
task('uploads:pull', function () {
    runLocally('rsync -avz -e "ssh -p {{port}}" {{user}}@{{host}}:{{path}}/shared/web/app/uploads ./web/app');
});

// Push uploads
task('uploads:push', function () {
    runLocally('rsync -avz -e "ssh -p {{port}}" ./web/app/uploads {{user}}@{{host}}:{{path}}/shared/web/app');
});
