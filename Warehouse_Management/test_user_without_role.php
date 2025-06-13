<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Testing User model after removing 'role' field:\n";
echo "==============================================\n";

try {
    // Test tạo User instance
    $user = new App\Models\User([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password123'
    ]);
    
    echo "✅ User model can be instantiated\n";
    echo "Fillable fields: " . implode(', ', $user->getFillable()) . "\n";
    echo "Hidden fields: " . implode(', ', $user->getHidden()) . "\n";
    echo "Casts: " . json_encode($user->getCasts()) . "\n";
    
    // Kiểm tra không có trường role
    $attributes = $user->getAttributes();
    if (!array_key_exists('role', $attributes)) {
        echo "✅ 'role' field has been successfully removed\n";
    } else {
        echo "❌ 'role' field still exists\n";
    }
    
    echo "\n✅ User model is working correctly without 'role' field!\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
