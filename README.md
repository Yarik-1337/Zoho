# Web Form for Zoho CRM Deals

## Technology Stack

- **PHP**: 8.1
- **Laravel**: 10
- **Vue**: 3.5


## Installation and Setup


- PHP 8.1 or higher
- Composer
- Node.js and npm

cp .env.example .env

composer install
npm install

php artisan key:generate

Configure Environment Variables
.env

- ZOHO_CLIENT_ID=your_zoho_client_id
- ZOHO_CLIENT_SECRET=your_zoho_client_secret
- ZOHO_REFRESH_TOKEN=your_zoho_refresh_token
- ZOHO_API_DOMAIN=https://www.zohoapis.eu
