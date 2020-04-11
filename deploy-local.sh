#! /bin/bash

apache_root="/var/www/html"
project_folder="des"

if [ -d $apache_root ]
then
    echo "Apache found"
else
    echo "Apache root ${apache_root} not found. Exiting."
    exit 1
fi

if [[ -d "${apache_root}/${project_folder}" ]]
then
    echo "Project folder already exists in apache root. Deleting..."
    rm -r ${apache_root}/${project_folder}
    echo "Deleted"
fi

    echo "Deploying the code..."
    mkdir ${apache_root}/${project_folder}
    cp -R .* ${apache_root}/${project_folder}
    echo "Deployment done. Visit serverurl/${project_folder}"
