
# Installation

``` composer symfony plugins

composer require --dev symfony/form
composer require --dev symfony/maker-bundle
composer require --dev symfony/translation
composer require --dev symfony/orm-make
composer require --dev symfony/annotations
composer require --dev symfony/doctrine
composer require symfony/security-bundle
composer require onurb/doctrine-yuml-bundle

```


## Set Up

```bash
php bin/console make:migration


Initial or default admin user creation:: atleast one admin user

php bin/console fos:user:create "admin"

php bin/console fos:user:activate "admin"

php bin/console fos:user:promote "admin" ROLE_SUPER_ADMIN
```

## Usage

```run through

php bin/console server:run

http:/127.0.0.1:8000/users

http:/127.0.0.1:8000/group/list

```

## Useful Internal API routes

```routes
doctrine_yuml_mapping               ANY        ANY      ANY    /my_prefix/yuml
users                               ANY        ANY      ANY    /users/
user_new                            ANY        ANY      ANY    /users/new
user_edit                           ANY        ANY      ANY    /users/{id}/edit
user_update                         POST       ANY      ANY    /users/{id}/update
user_delete                         GET        ANY      ANY    /users/{id}/delete
user_group_delete                   GET        ANY      ANY    /users/{id}/deleteusergroup
group_delete                        GET        ANY      ANY    /users/{id}/deletegroup
fos_user_group_list                 GET        ANY      ANY    /group/list
fos_user_group_new                  GET|POST   ANY      ANY    /group/new
fos_user_group_show                 GET        ANY      ANY    /group/{groupName}
fos_user_group_edit                 GET|POST   ANY      ANY    /group/{groupName}/edit
fos_user_group_delete               GET        ANY      ANY    /group/{groupName}/delete
```

``` to see full list of routes

php bin/console debug:router

```






