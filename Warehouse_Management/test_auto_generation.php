<?php

// Test script to verify the auto-generation functionality
require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    echo "Testing Store access...\n";
    $stores = \App\Models\Store::inRandomOrder()->limit(1)->get();
    echo "Found " . $stores->count() . " stores\n";
    
    if ($stores->count() > 0) {
        echo "First store: " . $stores->first()->name . "\n";
    }
    
    echo "Testing Product access...\n";
    $products = \App\Models\Product::all();
    echo "Found " . $products->count() . " products\n";
    
    if ($products->count() >= 3) {
        echo "Auto-generation should work with " . $products->count() . " products\n";
    } else {
        echo "Need at least 3 products for auto-generation\n";
    }
    
    echo "Test completed successfully!\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
}
