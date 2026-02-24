<?php
require_once __DIR__ . '/../src/Traits/HasHumanTime.php';

class TimeDemo {
    use \App\Traits\HasHumanTime;
}

$helper = new TimeDemo();
$selectedDate = $_POST['dob'] ?? null;
$ageResult = $selectedDate ? $helper->getDetailedAge($selectedDate) : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Age Calculator | Precise Time</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 text-slate-200 min-h-screen flex items-center justify-center p-6 font-sans">

    <div class="w-full max-w-lg">
        <div class="mb-8 text-center">
            <h1 class="text-4xl font-extrabold text-white tracking-tight">Life <span class="text-indigo-500">Counter</span></h1>
            <p class="text-slate-400 mt-2">Calculate your precise time on Earth</p>
        </div>

        <div class="bg-slate-900 border border-white/10 p-8 rounded-3xl shadow-2xl mb-6">
            <form method="POST" class="space-y-6">
                <div>
                    <label for="dob" class="block text-sm font-medium text-slate-400 mb-2">Select Date of Birth</label>
                    <input type="datetime-local" name="dob" id="dob" 
                           value="<?= $selectedDate ?>"
                           class="w-full bg-slate-800 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                </div>
                
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-4 rounded-xl shadow-lg shadow-indigo-950 transition-all transform active:scale-95">
                    Calculate Age
                </button>
            </form>
        </div>

        <?php if ($ageResult): ?>
        <div class="relative group">
            <div class="absolute -inset-0.5 bg-gradient-to-r from-indigo-500 to-cyan-500 rounded-2xl blur opacity-30 animate-pulse"></div>
            <div class="relative bg-slate-900 border border-white/10 p-6 rounded-2xl">
                <h3 class="text-xs uppercase tracking-widest text-indigo-400 font-bold mb-3">Time Elapsed Since Birth</h3>
                <p class="text-white text-lg leading-relaxed font-mono">
                    <?= $ageResult ?>
                </p>
            </div>
        </div>
        <?php endif; ?>

        <div class="mt-8 pt-6 border-t border-white/5 flex justify-between items-center text-[10px] text-slate-500 uppercase tracking-widest">
            <span>Powered by PHP DateTime</span>
            <span>v2.0.0 Stable</span>
        </div>
    </div>

</body>
</html>