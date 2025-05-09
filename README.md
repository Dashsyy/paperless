## 🔧 Docker Image Build Usage

You can build your Laravel app Docker image using a custom Artisan command.

### With prompt (interactive):

```bash
php artisan docker:build
# Prompts: Enter image version (e.g. 1.0.0 or latest): 1.0.2
# => Builds: your-app-name:1.0.2


php artisan docker:build --tag=1.0.5
# => Builds: your-app-name:1.0.5
```

### Features

