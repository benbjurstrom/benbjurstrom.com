---
title: 'Laravel Vapor and the AWS Lambda 50MB Limit'
date: '2023-05-20T08:00:00.000Z'
excerpt: 'Strategies for optimizing your Laravel Vapor application to fit within with the AWS Lambda 50MB Limit.'
author:
    name: Ben Bjurstrom
    picture: 'https://benbjurstrom.com.s3-us-west-2.amazonaws.com/img/headshot.jpg'
ogImage:
    url: 'https://s3-us-west-2.amazonaws.com/benbjurstrom.com/img/vapor-limit/laravel-vapor-50mb-limit.jpg'
---
I've been working with Laravel vapor over the  last several years and one thing that comes up every now and then is hitting the 50MB AWS Lambda limit. As the Laravel Vapor documentation states:

> AWS Lambda has strict limitations on the size of applications running within the environment. If your application exceeds this limit, you may take advantage of Vapor's Docker-based deployments. Docker-based deployments allow you to package and deploy applications up to 10GB in size.

If you've hit the 50MB limit you might be considering using a Docker runtime as a potential solution. While this is a perfectly valid option, it comes with its own set of complexities and as you'll see may not be necessary for your application.

## What about Reusable Vendors?

Indeed, Laravel Vapor introduced the concept of [Reusable Vendors](https://blog.laravel.com/vapor-reusable-vendors) back in 2019 to help reduce the size of your deployment package by reusing common vendor dependencies. 

However, that functionality never worked with the Amazon Linux 2 runtimes and now seems to have been [officially deprecated](https://github.com/laravel/vapor-cli/blob/master/src/BuildProcess/ValidateManifest.php#L33). Given the depreciation of Reusable Vendors here are four alternatives that you can use to get your application size down:

## 1. Configure your `vapor.yml` file to ignore unnecessary folders
The vapor.yml file allows you to specify folders to ignore during the deployment. This is handy for excluding folders that are not needed in your vapor environment. As an example, in my application I add the following folders to my ignore array:
```yaml
        ignore:
          - .github
          - tests
          - docker
          - cypress
          - bootstrap/ssr
```

## 2. Running `composer install --no-dev`
By default, running `composer install` will include both the production and development dependencies. Appending the `--no-dev` flag will prevent Composer from installing the development dependencies thus reducing the size of your application bundle. In my app here's an example of the dependencies I keep in the `require-dev` section of my `composer.json` when using the `--no-dev` flag none of these dependencies are included in my vapor deployment.
```json
    "require-dev": {
    "fakerphp/faker": "^1.19",
    "hammerstone/airdrop": "^0.2.3",
    "itsgoingd/clockwork": "^5.1",
    "laravel/breeze": "^1.15",
    "laravel/sail": "^1.15",
    "laravel/tinker": "^2.7",
    "laravel/vapor-cli": "^1.44",
    "mockery/mockery": "^1.5",
    "nunomaduro/collision": "^7.0",
    "nunomaduro/larastan": "^2.6",
    "orangehill/iseed": "dev-master",
    "pestphp/pest": "^2.3",
    "pestphp/pest-plugin-laravel": "^2.0",
    "pestphp/pest-plugin-mock": "^2.0",
    "phpmd/phpmd": "^2.12",
    "sammyjo20/saloon-laravel": "^2.0",
    "spatie/enum": "^3.13",
    "spatie/laravel-ignition": "^2.0",
    "spatie/laravel-typescript-transformer": "^2.1",
    "tightenco/duster": "^0.6.0"
},
```

## 3. Remove the `node_modules` folder after compiling JavaScript. 
   If you're using a JavaScript build tool like Laravel Mix or Vite, it's likely that you'll have a node_modules directory in your project. This directory can be quite large and is not needed once your JavaScript has been compiled.

In my applications I remove the node_modules folder by adding the following to the build key of my `vapor.yml` file:
```yaml
        build:
          - 'rm -rf node_modules'
```

## 4. Remove unused services from the aws/aws-sdk-php package
Recently a feature was [merged](https://github.com/aws/aws-sdk-php/pull/2456) into the official aws/aws-sdk-php package that allows you to remove unused services. Because this package is required by every Laravel Vapor application, this can have a significant impact on your bundle size. **In my app removing unused services reduced my application deployment by over 30MB!**

To set this up you'll need to first identify which services you are using by adding a key called `aws/aws-sdk-php` under the `extra` key in your `composer.json` file. Here's what I'm using in my app, but if you are using different AWS services you'll need to adjust accordingly:
```json
"extra": {
  "aws/aws-sdk-php": [
    "CloudWatch",
    "CloudWatchLogs",
    "Iam",
    "Lambda",
    "S3",
    "Sqs",
    "Ssm"
  ]
},
```

Then to actually remove any unused services add the following to your `composer.json` scripts object. This will run the new `removeUnusedServices` command as part of the composer dump-autoload lifecycle.
```json
"pre-autoload-dump": "Aws\\Script\\Composer\\Composer::removeUnusedServices",
```
