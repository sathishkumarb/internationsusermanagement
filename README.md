
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
composer require stof/doctrine-extensions-bundle

```


## Set Up

```bash
php bin/console doctrine:database:create

php bin/console make:migration (optional all migrations exists)

php bin/console doctrine:migrations:migrate


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

To list users
users                               ANY        ANY      ANY    /users/

To create user
user_new                            ANY        ANY      ANY    /users/new

To edit the user with id as get parameter
user_edit                           ANY        ANY      ANY    /users/{id}/edit
user_update                         POST       ANY      ANY    /users/{id}/update


To delete the user with id as get parameter (there is a validation if a member of a group)
user_delete                         GET        ANY      ANY    /users/{id}/delete


To remove the user from group
user_group_delete                   GET        ANY      ANY    /users/{id}/deleteusergroup


To delete the group
group_delete                        GET        ANY      ANY    /users/{id}/deletegroup
fos_user_group_list                 GET        ANY      ANY    /group/list
fos_user_group_new                  GET|POST   ANY      ANY    /group/new
fos_user_group_show                 GET        ANY      ANY    /group/{groupName}
fos_user_group_edit                 GET|POST   ANY      ANY    /group/{groupName}/edit
fos_user_group_delete               GET        ANY      ANY    /group/{groupName}/delete
```


## Notes

```
EasyAdmin with sonatabundles is readily available but i did not go with that approach.
 
FOSUSERBUNDLE is overridden and customer user group controller created along overrding fosuser

HTTP PUT & DELETE was not handled via form might be a slight security breach here due to time constraints in edit and delete routes

PURE FOS_USER_BUNDLE + Symfony 4 Rest based auth + API creation can be done following the link below

https://medium.com/@joeymasip/how-to-create-an-api-with-symfony-4-and-jwt-b2334a8fbec2

Please dont hesitate to compliant a bug or feedback
```






