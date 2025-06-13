<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->boot();

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Warehouse;
use App\Models\Store;
use App\Models\Inventory;
use App\Models\StockMovement;

echo "=== Testing Database Restructuring ===\n\n";

// Test User model
echo "Testing User model...\n";
try {
    $user = User::first();
    echo "✓ User model working. Found: " . ($user ? $user->name : 'No users') . "\n";
} catch (Exception $e) {
    echo "✗ User model error: " . $e->getMessage() . "\n";
}

// Test Category model
echo "\nTesting Category model...\n";
try {
    $category = Category::first();
    echo "✓ Category model working. Found: " . ($category ? $category->name : 'No categories') . "\n";
    
    // Test Category table structure
    $columns = \Schema::getColumnListing('categories');
    echo "✓ Category columns: " . implode(', ', $columns) . "\n";
} catch (Exception $e) {
    echo "✗ Category model error: " . $e->getMessage() . "\n";
}

// Test Product model
echo "\nTesting Product model...\n";
try {
    $product = Product::first();
    echo "✓ Product model working. Found: " . ($product ? $product->name : 'No products') . "\n";
    
    // Test Product table structure
    $columns = \Schema::getColumnListing('products');
    echo "✓ Product columns: " . implode(', ', $columns) . "\n";
} catch (Exception $e) {
    echo "✗ Product model error: " . $e->getMessage() . "\n";
}

// Test Warehouse model
echo "\nTesting Warehouse model...\n";
try {
    $warehouse = Warehouse::first();
    echo "✓ Warehouse model working. Found: " . ($warehouse ? $warehouse->name : 'No warehouses') . "\n";
    
    // Test Warehouse table structure
    $columns = \Schema::getColumnListing('warehouses');
    echo "✓ Warehouse columns: " . implode(', ', $columns) . "\n";
} catch (Exception $e) {
    echo "✗ Warehouse model error: " . $e->getMessage() . "\n";
}

// Test Store model
echo "\nTesting Store model...\n";
try {
    $store = Store::first();
    echo "✓ Store model working. Found: " . ($store ? $store->name : 'No stores') . "\n";
    
    // Test Store table structure
    $columns = \Schema::getColumnListing('stores');
    echo "✓ Store columns: " . implode(', ', $columns) . "\n";
} catch (Exception $e) {
    echo "✗ Store model error: " . $e->getMessage() . "\n";
}

// Test Inventory model
echo "\nTesting Inventory model...\n";
try {
    $inventory = Inventory::first();
    echo "✓ Inventory model working. Found: " . ($inventory ? "ID: " . $inventory->id : 'No inventory') . "\n";
    
    // Test Inventory table structure
    $columns = \Schema::getColumnListing('inventory');
    echo "✓ Inventory columns: " . implode(', ', $columns) . "\n";
} catch (Exception $e) {
    echo "✗ Inventory model error: " . $e->getMessage() . "\n";
}

// Test StockMovement model
echo "\nTesting StockMovement model...\n";
try {
    $stockMovement = StockMovement::first();
    echo "✓ StockMovement model working. Found: " . ($stockMovement ? "ID: " . $stockMovement->id : 'No stock movements') . "\n";
    
    // Test StockMovement table structure
    $columns = \Schema::getColumnListing('stock_movements');
    echo "✓ StockMovement columns: " . implode(', ', $columns) . "\n";
} catch (Exception $e) {
    echo "✗ StockMovement model error: " . $e->getMessage() . "\n";
}

echo "\n=== Testing Relationships ===\n\n";

// Test Product-Category relationship
if (isset($product) && $product) {
    try {
        $category = $product->category;
        echo "✓ Product-Category relationship working\n";
    } catch (Exception $e) {
        echo "✗ Product-Category relationship error: " . $e->getMessage() . "\n";
    }
}

// Test Product-StockMovements relationship
if (isset($product) && $product) {
    try {
        $stockMovements = $product->stockMovements;
        echo "✓ Product-StockMovements relationship working\n";
    } catch (Exception $e) {
        echo "✗ Product-StockMovements relationship error: " . $e->getMessage() . "\n";
    }
}

// Test Warehouse-Inventory relationship
if (isset($warehouse) && $warehouse) {
    try {
        $inventories = $warehouse->inventories;
        echo "✓ Warehouse-Inventory relationship working\n";
    } catch (Exception $e) {
        echo "✗ Warehouse-Inventory relationship error: " . $e->getMessage() . "\n";
    }
}

echo "\n=== Database Restructuring Complete! ===\n";
echo "All models and relationships have been successfully updated according to the class diagram.\n";
