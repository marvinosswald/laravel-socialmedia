#laravel-socialmedia

[![Build Status](https://travis-ci.org/marvinosswald/laravel-socialmedia.svg?branch=master)](https://travis-ci.org/marvinosswald/laravel-socialmedia)
[![MIT License](https://img.shields.io/packagist/l/marvinosswald/laravel-socialmedia.svg?style=flat-square)](https://packagist.org/packages/marvinosswald/laravel-socialmedia)

## Install
```

    'providers' = [
    ...
        marvinosswald\Socialmedia\Providers\SocialmediaServiceProvider::class
    ],
    'aliases' = [
    ...
        'Socialmedia' => marvinosswald\Socialmedia\Facades\Socialmedia::class
    ]
```

## Usage

```
Socialmedia::post($params,$drivers=[]);
```

## Drivers

Socialmedia Network Drivers, in the process I would like to craft somekind of unified api for all of them

### Facebook

[Api Documentation](https://developers.facebook.com/docs/graph-api/reference/v2.7/post)

Obtain permanent Access Token: http://stackoverflow.com/a/28418469
#### Settings
##### ENV Variables
 - FACEBOOK_APP_ID
 - FACEBOOK_APP_SECRET
 - FACEBOOK_ACCESS_TOKEN

### Twitter

[Api Documentation](https://dev.twitter.com/rest/reference/post/statuses/update)

Obtain permanent Access Token: https://dev.twitter.com/oauth/overview/application-owner-access-tokens

#### Settings
##### ENV Variables
 - TWITTER_ACCESS_TOKEN
 - TWITTER_ACCESS_TOKEN_SECRET
 - TWITTER_CONSUMER_KEY
 - TWITTER_CONSUMER_SECRET

### Pinterest

[Api Documentation](https://developers.pinterest.com/docs/api/pins/)

### Instagram

[Hacky api endpoint](http://stackoverflow.com/a/26186389)

### Google+

[API Documentation](https://developers.google.com/+/domains/api/activities/insert)