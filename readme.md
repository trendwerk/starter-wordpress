# Installation

1. Click the green "Use this template" button on [this Github page](https://github.com/trendwerk/starter-wordpress) and create a new repository from the template.
2. Clone the new repository (`git clone git@github.com:<owner>/<repository>.git`)
3. Copy `.env.example` to `.env` and add the required constants
4. Install dependencies via `composer install`
5. Rename the theme folder, and update info in `style.css`, `composer.json`, namespaces and textdomain
6. Start developing 😁

# Deployment

Follow the following steps to setup deployment via Deployer:

1. If you haven’t already done so, install [Deployer](https://deployer.org/docs/installation.html) on your machine
2. Set `application`, `repository`, `host` and other variables in `deploy.php`
3. SSH into the remote server (`dep ssh`)
4. Create a `.env` file in the `shared` folder and add the required constants
5. Run `ssh-keygen` and press enter a few times to generate a SSH key pair without a passphrase
6. Add the new SSH key to the SSH Agent:
```
eval "$(ssh-agent -s)"
ssh-add ~/.ssh/id_rsa
```
7. Add the public key to `authorized_keys_custom`:
```
cat id_rsa.pub >> ~/.ssh/authorized_keys_custom
```
8. Add the public key to `known_hosts`:
```
cat id_rsa.pub >> ~/.ssh/known_hosts
```
9. Go to your repository settings on Github.com
10. Go to "Deploy keys" and add the public key (`cat id_rsa.pub` on remote server)
11. Go to Secrets and add `PRIVATE_KEY` (`cat id_rsa` on remote server)
12. Go to Secrets and add `KNOWN_HOSTS` (`ssh-keyscan <server-hostname>` on remote server)

Changes to the master branch will now be automatically deployed to the server. Or you can run `dep deploy production` on your local machine to deploy.

## Depoyer tasks

You can use the following tasks to SSH into the database or pull or push the database and uploads from and to the remote server:

- Deploy to production: `dep deploy production`
- Pull database: `dep db:pull production`
- Push database: `dep db:push production`
- Pull uploads: `dep uploads:pull production`
- Push uploads: `dep uploads:push production`
- SSH into server: `dep ssh`

You can find more info on [CLI usage](https://deployer.org/docs/cli.html) on the Deployer website.
