# ssh starter-wordpress.twservices.eu@tw-server-02.twservices.eu -p2223
server 'tw-server-02.twservices.eu', user: 'starter-wordpress.twservices.eu', roles: %w{web app db}, port: 2223

set :deploy_to, -> { '/var/www/vhosts/TB01-004/staging.trendwerk.nl/domains/starter-wordpress.staging.trendwerk.nl' }
set :varnish_url, 'starter-wordpress.staging.trendwerk.nl'
set :wpcli_remote_url, 'http://starter-wordpress.staging.trendwerk.nl'


