# Laravel + Vue + Firebase Stack

## Recommended IDE Setup

[VSCode](https://code.visualstudio.com/)

## Type Support for `.vue` Imports in TS

## Pre-requisites
-PHP version 8.3.4
-Node version 21.7.2
-GRPC(To enable development and execution of Google Firebase services - open source high performance remote procedure call framework) 
Reference for GRPC: https://cloud.google.com/php/grpc

## Project Setup

BACKEND SETUP COMMANDS

```sh
composer update
```

```sh
cp .env.example .env
```

```sh
php artisan key:generate
```

```sh
php artisan serve
```

FRONTEND SETUP COMMANDS

```sh
npm install
```

### Compile and Hot-Reload for Development

```sh
npm run dev
```

### Type-Check, Compile and Minify for Production

```sh
npm run build
```
