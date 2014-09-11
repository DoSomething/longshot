# config/deploy.rb file

set :application, "scholarship-application-app"
set :deploy_to, ENV["DEPLOY_PATH"]

set :user, "ubuntu"
set :group, "ubuntu"
set :use_sudo, false

set :repository, "."
set :scm, :none
set :deploy_via, :copy

set :ssh_options, {keys: ENV["CAP_PRIVATE_KEY"]}
