echo "Generating controllers and models..."

php artisan make:controller FacultyDataController --resource
php artisan make:model FacultyData --migration

php artisan make:controller ProdiDataController --resource
php artisan make:model ProdiData --migration

php artisan make:controller RolesController --resource
php artisan make:model Roles --migration

php artisan make:controller DosenPembimbingController --resource
php artisan make:model DosenPembimbing --migration

php artisan make:controller MahasiswaController --resource
php artisan make:model Mahasiswa --migration

php artisan make:controller CapaianJuaraController --resource
php artisan make:model CapaianJuara --migration

php artisan make:controller KepesertaanController --resource
php artisan make:model KepesertaanData --migration

php artisan make:controller ProfileUserController --resource
php artisan make:model ProfileUser --migration

php artisan make:controller KategoriController --resource
php artisan make:model KategoriData --migration

php artisan make:controller PrestasiController --resource
php artisan make:model PrestasiData --migration

php artisan make:controller UsersController --resource
php artisan make:model Users --migration

php artisan make:controller FilesUploadController --resource
php artisan make:model FilesUpload --migration

php artisan make:controller PosisiDataController --resource
php artisan make:model PosisiData --migration

php artisan make:controller PrestasiLombaController --resource
php artisan make:model Prestasi --migration

echo "Controllers and models generated successfully."
