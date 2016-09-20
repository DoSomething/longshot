# config/deploy.rb file
require 'bundler/capistrano'

set :application, "longshot"
set :deploy_to, ENV["DEPLOY_PATH"]
server  ENV["SERVER_NAME"], :app, :web

set :user, "dosomething"
set :group, "dosomething"
set :use_sudo, false

set :repository, "."
set :scm, :none
set :deploy_via, :copy
set :keep_releases, 1

ssh_options[:keys] = [ENV["CAP_PRIVATE_KEY"]]

default_run_options[:shell] = '/bin/bash'

namespace :deploy do
  folders = %w{logs dumps system}

  task :link_folders do
    run "ln -nfs #{shared_path}/.env #{release_path}/"
    run "ln -nfs #{shared_path}/content #{release_path}/public"

    folders.each do |folder|
      run "rm -rf #{release_path}/storage/#{folder}"
      run "ln -nfs #{shared_path}/#{folder} #{release_path}/storage/#{folder}"
    end
  end

  task :artisan_migrate do
    run "cd #{release_path} && php artisan migrate --force"
  end

  task :artisan_cache_clear do
    run "cd #{release_path} && php artisan cache:clear"
  end

  task :artisan_custom_styles do
    run "cd #{release_path} && php artisan custom-styles"
  end

  task :restart_queue_worker, :on_error => :continue do
    run "ps -ef | grep 'queue:work' | awk '{print $2}' | xargs sudo kill -9"
  end

end

after "deploy:update", "deploy:cleanup"
after "deploy:create_symlink", "deploy:link_folders"
after "deploy:link_folders", "deploy:restart_queue_worker"
after "deploy:restart_queue_worker", "deploy:artisan_migrate"
after "deploy:artisan_migrate", "deploy:artisan_custom_styles"
