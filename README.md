# Setup Instructions

# Download the project 
```bash 
git@github.com:bhargavjoshi/trello-laravel-vue.git
```

#Go to project folder
```bash 
cd trello-laravel-vue
```


#Install Composer dependancies
```bash 
composer install
```

#Copy Environemnt variable
```bash 
cp .env.example .env
```

#Set environment variable
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=trello_demo
DB_USERNAME=root
DB_PASSWORD=
```

#Migrate Database
```bash 
php artisan migrate:fresh
```

#Install NPM dependancies
```bash 
npm install
```

#Complie Vue Files
```bash 
npm run production
```

# That's it Open the homepage and the Vue app will be loaded


