# RaphyEpitechUserBundle

This bundle provides the user component for Synfony2 using the Epitech's Intranet authentication.

## Installation & Setting Up

### 1) Add the package to your project

```bash
$> composer require raphy/epitech-user-bundle ~1.0
```

or

```js
// composer.json
"require": {
    // ...
    "raphy/epitech-user-bundle": "~1.0"
    // ...
}
```

### 2) Add the bundle to your project
Then in your `AppKernel.php`, register the bundle:
```php
// AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Raphy\Epitech\UserBundle(),
        // ...
    );
}
```

### 3) Configure the security layer

```yaml
# security.yml

security:
    providers:
        epitech:
            id: raphy_epitech_user.user.provider

    encoders:
            Raphy\Epitech\UserBundle\Entity\User: plaintext

    firewalls:
        dev:
            pattern: ^/(_(profiler|wdt)|css|images|js)/
            security: false

        main:
            pattern:                    ^/
            anonymous:                  true
            provider:                   epitech
            switch_user:                true
            logout:
                path:                   app_authentication_logout # Your route name for logging out
                target:                 app_index # Your route name to redirect after logged out
            intranet_login:
                csrf_provider:          form.csrf_provider
                login_path:             app_authentication_login # Your route name for logging in
                check_path:             app_authentication_login_check # Your route name for logging in check
                default_target_path:    app_index # Your route name to redirect after logged in
                post_only:              true
            # Add auto remember me
            remember_me:
                key:                    "%secret%"
                lifetime:               604800
                path:                   app_index
                always_remember_me:     true
```

### 4) Create your authentication controller

Now you have to create your authentication controller for the logging in and all the routes in your `routing.yml`.