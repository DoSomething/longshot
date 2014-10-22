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
set :default_environment, {
  'S3_BUCKET' => ENV["S3_BUCKET"]
}

ssh_options[:keys] = [ENV["CAP_PRIVATE_KEY"]]

default_run_options[:shell] = '/bin/bash'

namespace :deploy do
  folders = %w{logs dumps system}

  task :backup_db do
    run "cd #{release_path} && php artisan db:backup --upload-s3 $S3_BUCKET"
  end

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

  task :artisan_custom_styles do
    run "cd #{release_path} && php artisan custom-styles"
  end

  task :restart_queue_worker, :on_error => :continue do
    run "ps -ef | grep 'queue:work' | awk '{print $2}' | xargs sudo kill -9"
  end

end

after "deploy:update", "deploy:cleanup"
after "deploy:symlink", "deploy:link_folders"
before "deploy:artisan_migrate", "deploy:backup_db"
after "deploy:link_folders", "deploy:restart_queue_worker", "deploy:artisan_migrate", "deploy:artisan_custom_styles"
