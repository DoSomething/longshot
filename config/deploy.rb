# config/deploy.rb file
require 'bundler/capistrano'

set :application, "scholarship-application-app"
set :deploy_to, ENV["DEPLOY_PATH"]
server  ENV["SERVER_NAME"], :app, :web

set :user, "ubuntu"
set :group, "ubuntu"
set :use_sudo, false

set :repository, "."
set :scm, :none
set :deploy_via, :copy
set :keep_releases, 1

ssh_options[:keys] = [ENV["CAP_PRIVATE_KEY"]]

namespace :deploy do
  folders = %w{logs dumps system}

  task :link_folders do
    run "ln -nfs #{shared_path}/.env.php #{release_path}/"
    run "ln -nfs #{shared_path}/content #{release_path}/public"
    run "ln -nfs #{shared_path}/pages #{release_path}/public/pages"
    folders.each do |folder|
      run "ln -nfs #{shared_path}/#{folder} #{release_path}/app/storage/#{folder}"
    end
  end

  task :artisan_migrate do
    run "cd #{release_path} && php artisan migrate --force"
  end

end

after "deploy:update", "deploy:cleanup"
after "deploy:symlink", "deploy:link_folders"
after "deploy:link_folders", "deploy:artisan_migrate"
