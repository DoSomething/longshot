# config/deploy.rb file

set :application, "scholarship-application-app"
server "54.84.158.249", :app, :web
set :user, "ubuntu"
set :group, "ubuntu"
set :use_sudo, false

set :repository, "."
set :scm, :none
set :deploy_via, :copy
