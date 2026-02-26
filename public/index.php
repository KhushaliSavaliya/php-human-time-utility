<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/../src/Traits/HasHumanTime.php';

class TimeDemo {
    use \App\Traits\HasHumanTime;
}

$helper = new TimeDemo();
$selectedDate = $_POST['dob'] ?? null;
$ageResult = $selectedDate ? $helper->getDetailedAge($selectedDate) : null;
$stats = $selectedDate ? $helper->getStats($selectedDate) : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Life Counter Pro</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 text-slate-200 min-h-screen py-12 px-6 font-sans">

    <div class="max-w-2xl mx-auto">
        <div class="mb-10 text-center">
            <h1 class="text-5xl font-black text-white tracking-tighter mb-2">Life <span class="text-indigo-500">Counter</span></h1>
            <p class="text-slate-400">Deep analytics of your existence.</p>
        </div>

        <div class="bg-slate-900 border border-white/10 p-8 rounded-3xl shadow-2xl mb-8">
            <form method="POST" class="flex flex-col md:flex-row gap-4">
                <div class="flex-grow">
                    <input type="datetime-local" name="dob" required
                           value="<?= $selectedDate ?>"
                           class="w-full bg-slate-800 border border-white/10 rounded-2xl px-5 py-4 text-white focus:ring-2 focus:ring-indigo-500 outline-none transition">
                </div>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 px-8 py-4 rounded-2xl font-bold transition-all shadow-lg shadow-indigo-900/20">
                    Analyze
                </button>
            </form>
        </div>

        <?php if ($ageResult): ?>
            <div class="bg-indigo-600 rounded-3xl p-8 mb-6 shadow-xl relative overflow-hidden">
                <div class="relative z-10">
                    <h3 class="text-indigo-200 text-xs font-bold uppercase tracking-widest mb-2">Total Time Lived</h3>
                    <p class="text-2xl md:text-3xl font-bold text-white"><?= $ageResult ?></p>
                </div>
                <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="bg-slate-900 border border-white/10 p-5 rounded-2xl text-center">
                    <p class="text-slate-500 text-xs uppercase font-bold mb-1">Total Days</p>
                    <p class="text-2xl font-mono text-cyan-400"><?= $stats['total_days'] ?></p>
                </div>
                <div class="bg-slate-900 border border-white/10 p-5 rounded-2xl text-center">
                    <p class="text-slate-500 text-xs uppercase font-bold mb-1">Total Weeks</p>
                    <p class="text-2xl font-mono text-purple-400"><?= $stats['total_weeks'] ?></p>
                </div>
                <div class="bg-slate-900 border border-white/10 p-5 rounded-2xl text-center">
                    <p class="text-slate-500 text-xs uppercase font-bold mb-1">Total Hours</p>
                    <p class="text-2xl font-mono text-emerald-400"><?= $stats['total_hours'] ?></p>
                </div>
            </div>

            <div class="bg-slate-900/50 border border-dashed border-white/20 p-6 rounded-2xl text-center mb-8">
                <?php if ($stats['is_birthday']): ?>
                    <p class="text-xl font-bold text-yellow-400">🎉 Happy Birthday! Enjoy your day!</p>
                <?php else: ?>
                    <p class="text-slate-400">Next birthday in <span class="text-white font-bold"><?= $stats['days_until_next'] ?></span> days.</p>
                <?php endif; ?>
            </div>

            <h3 class="text-slate-500 text-xs font-bold uppercase tracking-widest mb-4 ml-2">Interplanetary Age</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="bg-gradient-to-br from-slate-900 to-orange-900/20 border border-white/5 p-5 rounded-2xl relative overflow-hidden">
                    <p class="text-slate-400 text-xs font-bold mb-1">Mercury Years</p>
                    <p class="text-3xl font-black text-orange-400"><?= $stats['mercury_age'] ?></p>
                    <div class="absolute -right-2 -bottom-2 opacity-10 text-4xl">☄️</div>
                </div>
                
                <div class="bg-gradient-to-br from-slate-900 to-red-900/20 border border-white/5 p-5 rounded-2xl relative overflow-hidden">
                    <p class="text-slate-400 text-xs font-bold mb-1">Mars Years</p>
                    <p class="text-3xl font-black text-red-500"><?= $stats['mars_age'] ?></p>
                    <div class="absolute -right-2 -bottom-2 opacity-10 text-4xl">🔴</div>
                </div>

                <div class="bg-gradient-to-br from-slate-900 to-yellow-900/20 border border-white/5 p-5 rounded-2xl relative overflow-hidden">
                    <p class="text-slate-400 text-xs font-bold mb-1">Jupiter Years</p>
                    <p class="text-3xl font-black text-yellow-600"><?= $stats['jupiter_age'] ?></p>
                    <div class="absolute -right-2 -bottom-2 opacity-10 text-4xl">🪐</div>
                </div>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>