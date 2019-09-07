Installation::

composer require --dev symfony/form
composer require --dev symfony/maker-bundle
composer require --dev symfony/translation
composer require --dev symfony/orm-make
composer require --dev symfony/annotations
composer require --dev symfony/doctrine
composer require symfony/security-bundle
composer require onurb/doctrine-yuml-bundle

Set up::

php bin/console make:migration


Initial or default admin user creation:: atleast one admin user

php bin/console fos:user:create

php bin/console fos:user:promote "username" ROLE_SUPER_ADMIN


please refer uml in root path:

yuml-mapping.png 



run through::

php bin/console server:run

http:/127.0.0.1:8000/users

http:/127.0.0.1:8000/group/list
 
 
 Useful complete routes or endpoints to use anywhere else as i did not develop a API routes
 
 
  users                               ANY        ANY      ANY    /users/
  user_new                            ANY        ANY      ANY    /users/new
  user_edit                           ANY        ANY      ANY    /users/{id}/edit
  user_update                         POST       ANY      ANY    /users/{id}/update
  user_delete                         GET        ANY      ANY    /users/{id}/delete
  user_group_delete                   GET        ANY      ANY    /users/{id}/deleteusergroup
  group_delete                        GET        ANY      ANY    /users/{id}/deletegroup
  fos_user_security_login             GET|POST   ANY      ANY    /login
  fos_user_security_check             POST       ANY      ANY    /login_check
  fos_user_security_logout            GET|POST   ANY      ANY    /logout
  fos_user_profile_show               GET        ANY      ANY    /profile/
  fos_user_profile_edit               GET|POST   ANY      ANY    /profile/edit
  fos_user_registration_register      GET|POST   ANY      ANY    /register/
  fos_user_registration_check_email   GET        ANY      ANY    /register/check-email
  fos_user_registration_confirm       GET        ANY      ANY    /register/confirm/{token}
  fos_user_registration_confirmed     GET        ANY      ANY    /register/confirmed
  fos_user_resetting_request          GET        ANY      ANY    /resetting/request
  fos_user_resetting_send_email       POST       ANY      ANY    /resetting/send-email
  fos_user_resetting_check_email      GET        ANY      ANY    /resetting/check-email
  fos_user_resetting_reset            GET|POST   ANY      ANY    /resetting/reset/{token}
  fos_user_change_password            GET|POST   ANY      ANY    /profile/change-password
  fos_user_group_list                 GET        ANY      ANY    /group/list
  fos_user_group_new                  GET|POST   ANY      ANY    /group/new
  fos_user_group_show                 GET        ANY      ANY    /group/{groupName}
  fos_user_group_edit                 GET|POST   ANY      ANY    /group/{groupName}/edit
  fos_user_group_delete               GET        ANY      ANY    /group/{groupName}/delete





