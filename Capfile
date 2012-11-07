load 'deploy' if respond_to?(:namespace)
require 'capistrano_colors'
default_run_options[:pty] = true

# Application
set   :application, "krasnoukhov.com"
set   :project, "krasnoukhov.com"
set   :domain, "krasnoukhov.com"
set   :deploy_to, "/var/www/krasnoukhov/#{project}/"
role  :web, domain

# Source
set   :scm, "git"
set   :repository, "git@github.com:krasnoukhov/#{project}.git"
set   :branch, "master"
set   :repository_cache, "git"
set   :deploy_via, :remote_cache
set   :user, "krasnoukhov"

# Options
set   :use_sudo, false
set   :keep_releases, 1