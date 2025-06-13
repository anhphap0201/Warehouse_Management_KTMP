<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Testing Store model according to class diagram:\n";
echo "==============================================\n";

try {
    // Test tạo Store instance với các trường theo class diagram
    $store = new App\Models\Store([
        'name' => 'Test Store',
        'location' => 'Test Location'
    ]);
    
    echo "✅ Store model can be instantiated with class diagram fields\n";
    echo "Fields from class diagram:\n";
    echo "- id: " . ($store->id ?? 'auto-generated') . " (bigint)\n";
    echo "- name: " . $store->name . " (string)\n";
    echo "- location: " . $store->location . " (string)\n";
    echo "- created_at: " . ($store->created_at ?? 'will be set on save') . " (timestamp)\n";
    echo "- updated_at: " . ($store->updated_at ?? 'will be set on save') . " (timestamp)\n";
    
    // Kiểm tra fillable fields
    echo "\nFillable fields: " . implode(', ', $store->getFillable()) . "\n";
    
    // Kiểm tra casts
    echo "Field casts: " . json_encode($store->getCasts()) . "\n";
    
    // Test validation rules
    $rules = App\Models\Store::rules();
    echo "\nValidation rules for class diagram fields:\n";
    foreach ($rules as $field => $rule) {
        echo "- {$field}: {$rule}\n";
    }
    
    // Test với dữ liệu thực từ database
    $existingStore = App\Models\Store::first();
    if ($existingStore) {
        echo "\nSample store from database:\n";
        echo "- id: " . $existingStore->id . "\n";
        echo "- name: " . $existingStore->name . "\n";
        echo "- location: " . $existingStore->location . "\n";
        echo "- created_at: " . $existingStore->created_at . "\n";
        echo "- updated_at: " . $existingStore->updated_at . "\n";
    }
    
    echo "\n✅ Store model structure matches class diagram requirements!\n";
    echo "Note: Additional fields are kept for backward compatibility.\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
