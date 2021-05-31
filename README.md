
## Installation

- `composer create-project --prefer-dist kushal/kushal-ecommerce`
- Edit `.env` and set your database connection details
- (When installed via git clone or download, run `php artisan key:generate` and `php artisan jwt:secret`)
- `php artisan migrate --seed`  <!--- To create tables and seed with sample data --> 
- `npm install`

## Usage

#### Development

```bash
# Build and watch
npm run watch

# Serve with hot reloading (not working)
npm run hot
```

#### Production

```bash
npm run production
```

## Laravel Application
To start the Laravel application in local machine.
```bash
php artisan serve
```

## Socialite

This project comes with GitHub as an example for [Laravel Socialite](https://laravel.com/docs/5.8/socialite).

To enable the provider create a new GitHub application and use `https://example.com/api/oauth/github/callback` as the Authorization callback URL.

Edit `.env` and set `GITHUB_CLIENT_ID` and `GITHUB_CLIENT_SECRET` with the keys form your GitHub application.

For other providers you may need to set the appropriate keys in `config/services.php` and redirect url in `OAuthController.php`.

## Email Verification

To enable email verification make sure that your `App\User` model implements the `Illuminate\Contracts\Auth\MustVerifyEmail` contract.

## Testing

```bash
# Run unit and feature tests
vendor/bin/phpunit

# Run Dusk browser tests
php artisan dusk
```
