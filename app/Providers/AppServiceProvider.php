<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\ServiceProvider;
// use Illuminate\Support\Str;
// use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $masterHelperFile = app_path('Helpers/master_helper.php');
        if (file_exists($masterHelperFile)) {
            require_once $masterHelperFile;
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Menangani kunci bahasa yang tidak ditemukan (Missing Keys)
        Lang::handleMissingKeysUsing(function (string $key, array $replacements, string $locale) {

            // Jika ada tanda titik (baik 1 titik maupun lebih, misal: 'admin.auth.failed')
            if (str_contains($key, '.')) {
                $result = str($key)
                    ->afterLast('.') // ambil bagian setelah titik terakhir
                    ->headline() // ubah menjadi format headline (huruf pertama kapital setiap kata)
                    ->lower() // ubah menjadi huruf kecil
                    ->ucfirst(); // ubah huruf pertama menjadi kapital

                return $result;
            }

            return $key;
        });

        // Jika ada module yang dihapus, jalankan perintah composer dump-autoload
        Event::listen('modules.*.deleted', function (): void {
            Process::path(base_path())->command('composer dump-autoload')->run();
        });

        Gate::before(function (User $user, string $ability) {
            return $user->hasRole('super-admin') ? true : null;
        });

    } // End function boot()
} // End Class.
