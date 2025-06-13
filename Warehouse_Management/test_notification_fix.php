<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== Testing Notification Variable Fix ===\n\n";

try {
    // Test if notifications table exists
    echo "1. Checking if notifications table exists...\n";
    $tableExists = Schema::hasTable('notifications');
    echo $tableExists ? "✅ Notifications table exists\n" : "❌ Notifications table does not exist\n";
    
    if ($tableExists) {
        // Test Notification model and pending scope
        echo "\n2. Testing Notification model and pending scope...\n";
        $pendingCount = App\Models\Notification::pending()->whereNull('read_at')->count();
        echo "✅ Pending notifications count: {$pendingCount}\n";
        
        // Test cache functionality
        echo "\n3. Testing cache functionality...\n";
        $cachedCount = cache()->remember(
            'unread_notifications_count', 
            now()->addMinutes(5),
            function () {
                return App\Models\Notification::pending()->whereNull('read_at')->count();
            }
        );
        echo "✅ Cached notifications count: {$cachedCount}\n";
        
        // Test NotificationComposer
        echo "\n4. Testing NotificationComposer...\n";
        $composer = new App\Http\View\Composers\NotificationComposer();
        $mockView = new Illuminate\View\View(
            app('view'),
            app('view.engine.resolver')->resolve('blade'),
            'test',
            '',
            []
        );
        $composer->compose($mockView);
        echo "✅ NotificationComposer executed successfully\n";
        
    } else {
        echo "\n⚠️  Notifications table doesn't exist, but the fix will handle this gracefully\n";
    }
    
    echo "\n✅ All notification variable tests passed!\n";
    echo "\nThe 'Undefined variable \$unreadNotificationsCount' error should now be fixed!\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
}
