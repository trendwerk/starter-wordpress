set :linked_dirs, fetch(:linked_dirs, []).push('web/app/uploads')
set :linked_files, fetch(:linked_files, []).push('.env')
set :repo_url, 'git@github.com:trendwerk/headless-wordpress.git'

task :opcache_reset do
  on roles(:deploy) do
    execute :'php-fpm-cli', "-r 'opcache_reset();'"
  end
end

after 'deploy:published', 'opcache_reset'
