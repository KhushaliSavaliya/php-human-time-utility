<?php
// Manual inclusion since we aren't using Composer autoload for this tiny task
require_once __DIR__ . '/../src/Traits/HasHumanTime.php';

class TimeDemo {
    use \App\Traits\HasHumanTime;
}

$helper = new TimeDemo();
// Mocking some data
$testDates = [
    'Just now' => date('Y-m-d H:i:s'),
    'Recent'   => date('Y-m-d H:i:s', strtotime('-15 minutes')),
    'Older'    => '2023-01-01 12:00:00'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Utility | Daily Streak</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900 min-h-screen flex items-center justify-center font-sans">

    <div class="relative group w-full max-w-md px-4">
        <div class="absolute -inset-1 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl blur opacity-25 group-hover:opacity-50 transition duration-1000"></div>
        
        <div class="relative bg-slate-900 border border-white/10 p-8 rounded-2xl shadow-2xl">
            <div class="flex justify-between items-start mb-8">
                <div>
                    <h1 class="text-white text-2xl font-bold tracking-tight">TimeAgo <span class="text-indigo-400">Helper</span></h1>
                    <p class="text-slate-400 text-sm">Lightweight PHP Trait Utility</p>
                </div>
                <span class="bg-indigo-500/10 text-indigo-400 text-[10px] font-bold px-2 py-1 rounded border border-indigo-500/20 uppercase">v1.0.0</span>
            </div>

            <div class="space-y-4">
                <?php foreach($testDates as $label => $date): ?>
                <div class="flex items-center justify-between p-4 bg-white/5 rounded-xl border border-white/5 hover:border-indigo-500/50 transition">
                    <span class="text-slate-300 text-sm font-medium"><?= $label ?></span>
                    <span class="text-indigo-400 font-mono text-sm"><?= $helper->getElapsed($date) ?></span>
                </div>
                <?php endforeach; ?>
            </div>

            <button onclick="window.location.reload()" class="w-full mt-8 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-3 rounded-xl shadow-lg shadow-indigo-500/20 transition-all active:scale-[0.98]">
                Refresh Timeline
            </button>
        </div>
    </div>

</body>
</html>