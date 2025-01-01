<?php

namespace Brightweb\Ecommerce\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Livewire\Livewire;

use Brightweb\Ecommerce\Livewire\Backend\Product;

class Brightlivewiresettings extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // You can optionally register bindings or configurations here
       
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
       

        // Discovering and registering Livewire components.
        $this->discoverAndRegisterLivewireComponents();
    }

    private function discoverAndRegisterLivewireComponents(): void
    {
        // Defining the directory where Livewire components are stored.
        $livewireDirectory = __DIR__.'/../Http/Livewire';
        
        // Checking if the directory exists before proceeding.
        if (!File::isDirectory($livewireDirectory)) {
            return;
        }

        // Setting the namespace for Livewire components.
        $namespace = "Brightweb\\Ecommerce\\Http\\Livewire";

        // Registering components in the specified directory.
        $this->registerComponentsInDirectory($livewireDirectory, $namespace);
    }

    private function registerComponentsInDirectory(string $directory, string $namespace): void
    {
        // Iterating over all files in the specified directory.
        foreach (File::allFiles($directory) as $file) {
            // Getting the relative path of the file.
            $relativePath = $file->getRelativePathname();
            
            // Constructing the class name from the file path.
            $className = str_replace(['/', '.php'], ['\\', ''], $relativePath);
            $fullClassName = $namespace . '\\' . $className;

            // Checking if the class exists.
            if (class_exists($fullClassName)) {
                // Creating an alias for the Livewire component.
                $alias = str_replace('\\', '.', strtolower($className));
                
                // Registering the Livewire component.
                Livewire::component("brightweb::$alias", $fullClassName);
                Log::info("Registered Livewire component: brightweb::$alias");
            } else {
                // Logging a warning if the class does not exist.
                Log::warning("Failed to register Livewire component: $fullClassName");
            }
        }
    }
}
