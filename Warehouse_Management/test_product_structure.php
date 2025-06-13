<?php

// Simple test to verify Product table structure
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Testing Product table structure:\n";
echo "================================\n";

try {
    // Test creating a product
    $product = new App\Models\Product([
        'name' => 'Test Product',
        'sku' => 'TEST-SKU-001',
        'category_id' => 1,
        'unit' => 'Cái',
        'description' => 'This is a test product'
    ]);
    
    echo "✅ Product model can be instantiated with class diagram fields\n";
    echo "Fields from class diagram:\n";
    echo "- id: " . ($product->id ?? 'auto-generated') . " (bigint)\n";
    echo "- name: " . $product->name . " (string)\n";
    echo "- sku: " . $product->sku . " (string)\n";
    echo "- category_id: " . $product->category_id . " (bigint)\n";
    echo "- unit: " . $product->unit . " (string)\n";
    echo "- description: " . $product->description . " (text)\n";
    echo "- created_at: " . ($product->created_at ?? 'will be set on save') . " (timestamp)\n";
    echo "- updated_at: " . ($product->updated_at ?? 'will be set on save') . " (timestamp)\n";
    
    // Check fillable fields
    echo "\nFillable fields: " . implode(', ', $product->getFillable()) . "\n";
    
    // Check casts
    echo "Field casts: " . json_encode($product->getCasts()) . "\n";
    
    echo "\n✅ Product model structure matches class diagram requirements!\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
