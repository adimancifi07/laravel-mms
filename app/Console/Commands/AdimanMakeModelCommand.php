<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class AdimanMakeModelCommand extends Command
{
    /**
     * Format perintah: php artisan adiman:make-model NamaModel -a
     * atau dengan opsi satuan: php artisan adiman:make-model NamaModel -c -m
     */
    protected $signature = 'adiman:make-model {name : Nama Model yang ingin dibuat (Contoh: PostModel)}
                            {--a|all : Membuat semua file pendukung (Controller, Migration, Factory, Seeder)}
                            {--c|c : Membuat file controller (PostController)}
                            {--m|m : Membuat file migration (create_t_post_table)}
                            {--f|f : Membuat file factory (PostFactory)}
                            {--s|s : Membuat file seeder (PostSeeder)}';

    protected $description = 'Membuat Model kustom beserta Controller, Migration, Factory, dan Seeder dengan format tabel t_';

    public function handle()
    {
        $modelName = $this->argument('name');

        // Membersihkan kata "Model" di akhir input untuk mempermudah penamaan file lain
        $baseName = preg_replace('/Model$/', '', $modelName);

        // Menentukan nama Model final (Tetap memakai akhiran Model sesuai request: PostModel)
        $finalModelName = $baseName . 'Model';

        // Format nama tabel: Post -> t_post
        $tableName = 't_' . Str::snake($baseName);

        // Jika opsi -a atau --all diaktifkan, maka semua opsi lainnya dianggap true
        $makeAll = $this->option('all');
        $makeController = $makeAll || $this->option('c');
        $makeMigration  = $makeAll || $this->option('m');
        $makeFactory    = $makeAll || $this->option('f');
        $makeSeeder     = $makeAll || $this->option('s');

        $this->info("Menginisialisasi pembuatan komponen untuk {$finalModelName}...");

        // 1. Membuat File Model
        $this->call('make:model', [
            'name' => $finalModelName
        ]);

        // Menyisipkan properti protected $table = 't_post' ke dalam file model
        $this->customizeModelTable($finalModelName, $tableName);

        // 2. Membuat File Controller
        if ($makeController) {
            $controllerName = $baseName . 'Controller';
            $this->call('make:controller', [
                'name' => $controllerName
            ]);
        }

        // 3. Membuat File Migration
        if ($makeMigration) {
            $this->call('make:migration', [
                'name' => "create_{$tableName}_table",
                '--create' => $tableName
            ]);

            $this->customizeMigrationSchema($tableName);
        }

        // 4. Membuat File Factory
        if ($makeFactory) {
            $factoryName = $baseName . 'Factory';
            $this->call('make:factory', [
                'name' => $factoryName,
                '--model' => $finalModelName
            ]);

            $this->customizeFactory($factoryName, $finalModelName);
        }

        // 5. Membuat File Seeder
        if ($makeSeeder) {
            $seederName = $baseName . 'Seeder';
            $this->call('make:seeder', [
                'name' => $seederName
            ]);

            $this->customizeSeeder($seederName, $finalModelName);
        }

        $this->info("Selesai! Semua file kustom untuk {$finalModelName} dengan tabel '{$tableName}' berhasil dibuat dengan standar Laravel.");
    }

    /**
     * Menyisipkan properti protected $table ke dalam file Model.
     */
    protected function customizeModelTable(string  $modelName, string $tableName)
    {
        $path = app_path("Models/{$modelName}.php");

        if (File::exists($path)) {
            $content = File::get($path);

            $property = "\n    protected \$table = '{$tableName}';\n";

            if (Str::contains($content, 'use HasFactory;')) {
                $content = str_replace('use HasFactory;', "use HasFactory;\n{$property}", $content);
            } else {
                $content = preg_replace('/(class\s+' . $modelName . '[^{]*\{)/', "$1{$property}", $content);
            }

            File::put($path, $content);
        }
    }

    /**
     * Memastikan struktur skema di file Migration menggunakan nama tabel t_ kustom.
     */
    protected function customizeMigrationSchema(string $tableName)
    {
        $files = File::glob(database_path("migrations/*_create_{$tableName}_table.php"));

        if (count($files) > 0) {
            $path = $files[0];
            $content = File::get($path);

            $content = str_replace("Schema::create('" . Str::plural($tableName) . "'", "Schema::create('{$tableName}'", $content);
            $content = str_replace("Schema::dropIfExists('" . Str::plural($tableName) . "'", "Schema::dropIfExists('{$tableName}'", $content);

            File::put($path, $content);
        }
    }

    /**
     * Menghubungkan Factory ke model bersuffix 'Model'.
     */
    protected function customizeFactory(string $factoryName, string $modelName)
    {
        $path = database_path("factories/{$factoryName}.php");

        if (File::exists($path)) {
            $content = File::get($path);

            $modelProperty = "\n    protected \$model = \\App\\Models\\{$modelName}::class;\n";

            $content = preg_replace('/(class\s+' . $factoryName . '\s+extends\s+Factory\s*\{)/', "$1{$modelProperty}", $content);

            File::put($path, $content);
        }
    }

    /**
     * Mengimpor nama Model ke dalam file Seeder.
     */
    protected function customizeSeeder(string $seederName, string $modelName)
    {
        $path = database_path("seeders/{$seederName}.php");

        if (File::exists($path)) {
            $content = File::get($path);

            $useStatement = "use App\Models\\{$modelName};\n";
            $content = preg_replace('/(namespace Database\\\Seeders;)/', "$1\n\n{$useStatement}", $content);

            $factoryCall = "        // Untuk menjalankan seeder, uncomment baris di bawah setelah mengisi Factory:\n        // {$modelName}::factory()->count(10)->create();";
            $content = preg_replace('/(public function run\(\): void\s*\{)/', "$1\n{$factoryCall}", $content);

            File::put($path, $content);
        }
    }
}
