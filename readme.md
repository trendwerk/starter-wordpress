# Installation

1. Go to https://github.com/trendwerk/starter-wordpress, click the green "Use this template" button and create a new repository from the template.

2. Clone the new repository (`git clone git@github.com:[owner]/[repository].git`)

3. Copy `.env.example` to `.env` and add the required constants

4. Install dependencies via `composer install`

5. Rename the theme folder, and update info in `style.css`, `composer.json`, namespaces and textdomain

6. Remove stuff you won't need

7. Start developing 😁

# Deployment

Follow the following steps to setup deployment via Deployer:

1. Install deployer (instructions: https://deployer.org/docs/installation.html)

2. Set `application`, `repository`, `host` and other variables in `deploy.php`

3. SSH into the remote server (`dep ssh`)

4. Create a `.env` file in the `shared` folder and add the required constants

5. Run `dep deploy production` on your local machine

# Automatic deployment via Github Actions

Follow the following steps to setup automatic deployment via Github Actions:

1. SSH into the remote server (`dep ssh`)

2. Run `ssh-keygen` and press enter a few times to generate a SSH key pair

3. Add the new SSH key to the SSH Agent, authorized keys and known hosts:

```
eval "$(ssh-agent -s)"
ssh-add ~/.ssh/id_rsa
cat id_rsa.pub >> ~/.ssh/authorized_keys_custom
cat id_rsa.pub >> ~/.ssh/known_hosts
```

4. Go to Github.com > [repository] > Settings

5. Go to Deploy keys and add "Production" key (run `cat id_rsa.pub` on remote server)

6. Go to Secrets and add `PRIVATE_KEY` (run `cat id_rsa` on remote server)

7. Do something with `KNOWN_HOSTS`??? (I'm stil working on this...)
