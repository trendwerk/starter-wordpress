set :linked_dirs, fetch(:linked_dirs, []).push('web/app/uploads')
set :linked_files, fetch(:linked_files, []).push('.env')
set :repo_url, 'git@github.com:trendwerk/headless-wordpress.git'

set :linked_dirs, fetch(:linked_dirs, []).push('web/app/uploads')
set :linked_files, fetch(:linked_files, []).push('.env')

set :wpcli_local_url, 'https://headless-wordpress.lndo.site'
set :wpcli_local_uploads_dir, "web/wp-content/uploads/"
set :wpcli_remote_uploads_dir, -> {"#{shared_path.to_s}/web/wp-content/uploads/"}

task :opcache_reset do
  on roles(:deploy) do
    execute :'php-fpm-cli', "-r 'opcache_reset();'"
  end
end

after 'deploy:published', 'opcache_reset'
