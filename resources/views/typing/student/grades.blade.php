<x-typing-app :role="'student'" :title="'คะแนนของฉัน - ระบบวิชาพิมพ์หนังสือราชการ 1'">
    <div class="space-y-10 pb-12">

        <!-- Aurora & Glass Header -->
        <div
            class="relative overflow-hidden bg-white border border-white/40 rounded-[2.5rem] p-8 md:p-10 shadow-2xl group transition-all duration-500 hover:shadow-primary-500/10">
            <!-- Aurora Background -->
            <div class="absolute inset-0 bg-gradient-to-br from-white via-primary-50/30 to-indigo-50/20 opacity-80">
            </div>
            <div
                class="absolute top-[-30%] right-[-10%] w-[600px] h-[600px] bg-gradient-to-br from-amber-300/10 via-primary-300/10 to-indigo-300/10 rounded-full blur-[80px] animate-pulse-slow pointer-events-none mix-blend-multiply">
            </div>

            <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-8">
                <div class="flex items-center gap-6">
                    <div
                        class="w-20 h-20 rounded-[2rem] bg-gradient-to-br from-amber-400 to-primary-600 text-white flex items-center justify-center shadow-2xl transform group-hover:rotate-6 transition-all duration-500">
                        <i class="fas fa-star text-4xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl md:text-4xl font-black text-gray-800 tracking-tight mb-2">คะแนนของฉัน</h1>
                        <p class="text-gray-500 font-medium text-lg flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                            สรุปผลการเรียนและความก้าวหน้าในรายวิชา
                        </p>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-4">
                    <div
                        class="flex items-center gap-4 p-2 pl-6 bg-white border border-gray-100 rounded-[2.5rem] shadow-sm">
                        <div class="text-right">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1">
                                YOUR RANK</p>
                            <p class="text-2xl font-black text-gray-800">#{{ $userRank }} <span
                                    class="text-xs text-gray-400 font-bold tracking-tighter italic">/
                                    {{ $totalStudents }}</span></p>
                        </div>
                        <div
                            class="w-14 h-14 rounded-full bg-gradient-to-br from-amber-400 to-orange-500 text-white flex items-center justify-center shadow-lg shadow-amber-400/20 {{ $userRank <= 3 ? 'animate-bounce-slow' : '' }}">
                            <i class="fas {{ $userRank <= 3 ? 'fa-crown' : 'fa-medal' }} text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Stats Bento -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
                $summaryStats = [
                    [
                        'label' => 'คะแนนรวมสะสม',
                        'value' => number_format($totalScore),
                        'sub' => 'Total Points Earned',
                        'icon' => 'fa-trophy',
                        'color' => 'from-primary-500 to-indigo-600',
                        'progress' => 100
                    ],
                    [
                        'label' => 'คะแนนเฉลี่ย',
                        'value' => number_format($avgScore, 1),
                        'sub' => 'Average per task',
                        'icon' => 'fa-chart-line',
                        'color' => 'from-emerald-500 to-teal-600',
                        'progress' => ($avgScore / 10) * 100 // Assuming max score per task is 10 or scale appropriately
                    ],
                    [
                        'label' => 'ความเร็วเฉลี่ย',
                        'value' => number_format($avgWpm, 0),
                        'sub' => 'WPM Average',
                        'icon' => 'fa-tachometer-alt',
                        'color' => 'from-indigo-500 to-blue-600',
                        'progress' => 80
                    ]
                ];
            @endphp

            @foreach($summaryStats as $stat)
                <div
                    class="group relative overflow-hidden bg-white rounded-[2.5rem] p-8 border border-gray-100 shadow-sm transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br {{ $stat['color'] }} opacity-[0.03] rounded-bl-[4rem] group-hover:scale-110 transition-transform">
                    </div>

                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-8">
                            <div
                                class="w-14 h-14 rounded-2xl bg-gradient-to-br {{ $stat['color'] }} text-white flex items-center justify-center shadow-lg group-hover:rotate-6 transition-all">
                                <i class="fas {{ $stat['icon'] }} text-xl"></i>
                            </div>
                            <p class="text-[10px] font-black text-gray-300 uppercase tracking-[0.2em]">{{ $stat['sub'] }}
                            </p>
                        </div>

                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">{{ $stat['label'] }}
                        </p>
                        <p class="text-4xl font-black text-gray-800 tracking-tighter mb-6">{{ $stat['value'] }}</p>

                        <div class="space-y-2">
                            <div
                                class="flex justify-between items-center text-[10px] font-black text-gray-400 uppercase tracking-widest">
                                <span>Performance Level</span>
                                <span class="text-primary-500">{{ number_format($stat['progress'] ?? 0) }}%</span>
                            </div>
                            <div class="h-2 bg-gray-50 rounded-full overflow-hidden border border-gray-100/50 p-0.5">
                                <div class="h-full bg-gradient-to-r {{ $stat['color'] }} rounded-full transition-all duration-1000 group-hover:opacity-80"
                                    style="width: {{ $stat['progress'] ?? 0 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Chapter Scores Section -->
        @if(isset($chapterScores) && $chapterScores->count() > 0)
            <div class="space-y-8">
                <div class="flex items-center gap-4">
                    <div class="h-px flex-1 bg-gradient-to-r from-transparent via-gray-200 to-transparent"></div>
                    <h3
                        class="px-8 py-2 rounded-full bg-white border border-gray-100 shadow-sm text-sm font-black text-gray-800 uppercase tracking-[0.3em]">
                        คะแนนแยกตามบทเรียน
                    </h3>
                    <div class="h-px flex-1 bg-gradient-to-r from-transparent via-gray-200 to-transparent"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($chapterScores as $chapter => $stats)
                        <div
                            class="group bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-500 hover:-translate-y-1 relative overflow-hidden">
                            <div
                                class="absolute top-[-10%] left-[-10%] w-24 h-24 bg-primary-500/5 rounded-full blur-2xl group-hover:scale-150 transition-transform">
                            </div>

                            <div class="relative z-10">
                                <div class="flex items-center justify-between mb-6">
                                    <h4 class="text-lg font-black text-gray-800 tracking-tight leading-tight max-w-[70%]">
                                        {{ $chapter ?: 'บทเรียนทั่วไป' }}</h4>
                                    <span
                                        class="px-3 py-1 rounded-lg bg-gray-100 text-[9px] font-black text-gray-500 uppercase tracking-widest border border-gray-200">
                                        {{ $stats['count'] }} งาน
                                    </span>
                                </div>

                                <div class="flex items-baseline gap-2 mb-8">
                                    <span
                                        class="text-4xl font-black text-primary-600 tracking-tighter">{{ $stats['total'] }}</span>
                                    <span class="text-xs font-bold text-gray-400 italic">/ {{ $stats['max'] }} คะแนน</span>
                                </div>

                                <div class="space-y-4">
                                    <div class="h-2.5 bg-gray-50 rounded-full overflow-hidden border border-gray-100 p-0.5">
                                        @php $perc = $stats['max'] > 0 ? ($stats['total'] / $stats['max']) * 100 : 0; @endphp
                                        <div class="h-full bg-gradient-to-r from-primary-500 to-indigo-600 rounded-full transition-all duration-1000"
                                            style="width: {{ $perc }}%"></div>
                                    </div>
                                    <div
                                        class="flex justify-between items-center text-[10px] font-bold uppercase tracking-widest">
                                        <span class="text-gray-400">เฉลี่ยต่อชิ้นงาน: <span
                                                class="text-gray-800">{{ number_format($stats['avg'], 1) }}</span></span>
                                        <span
                                            class="px-2 py-0.5 bg-primary-50 text-primary-600 rounded-md">{{ number_format($perc, 0) }}%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Chart & Breakdown -->
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
            <!-- Performance Chart -->
            <div
                class="lg:col-span-3 bg-white rounded-[2.5rem] p-8 md:p-10 border border-gray-100 shadow-sm transition-all duration-500 hover:shadow-2xl">
                <div class="flex items-center justify-between mb-10">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-500 flex items-center justify-center">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <h3 class="text-2xl font-black text-gray-800 tracking-tight">กราฟคะแนน 5 งานล่าสุด</h3>
                    </div>
                </div>

                <div class="h-72 w-full flex items-end justify-around px-4 border-b border-gray-100 pb-2 relative mb-8">
                    @if($submissions->count() > 0)
                        @foreach($submissions->take(5)->reverse() as $submission)
                            @php
                                $maxSub = $submission->assignment->max_score ?? 100;
                                $hPerc = $maxSub > 0 ? ($submission->score / $maxSub) * 100 : 0;
                                $isTop = $submission->score >= ($maxSub * 0.8);
                            @endphp
                            <div class="flex-1 flex flex-col items-center group/bar relative px-2 max-w-[80px]">
                                <!-- Info Bubble -->
                                <div
                                    class="absolute bottom-full mb-4 opacity-0 group-hover/bar:opacity-100 transition-opacity bg-gray-900 text-white text-[10px] font-black px-3 py-2 rounded-xl whitespace-nowrap z-20 pointer-events-none">
                                    {{ $submission->score }} / {{ $maxSub }}
                                </div>

                                <div class="w-full bg-gray-50 rounded-t-2xl relative overflow-hidden transition-all duration-500 group-hover/bar:bg-indigo-50"
                                    style="height: 100%">
                                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t {{ $isTop ? 'from-emerald-500 to-emerald-400' : 'from-primary-500 to-indigo-500' }} rounded-t-2xl transition-all duration-1000 shadow-lg"
                                        style="height: {{ $hPerc }}%">
                                        <div
                                            class="absolute inset-0 bg-white/10 opacity-0 group-hover/bar:opacity-100 animate-shimmer">
                                        </div>
                                    </div>
                                </div>
                                <span
                                    class="text-[9px] font-black text-gray-400 uppercase tracking-widest mt-4 text-center truncate w-full">{{ Str::limit($submission->assignment->title, 10) }}</span>
                            </div>
                        @endforeach
                    @else
                        <div class="absolute inset-0 flex flex-col items-center justify-center text-gray-300">
                            <i class="fas fa-chart-area text-5xl mb-4 opacity-30"></i>
                            <p class="font-black text-sm uppercase tracking-[0.2em] opacity-50">ไม่มีข้อมูลแสดงผล</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Score History -->
            <div
                class="lg:col-span-2 bg-white rounded-[2.5rem] p-8 border border-gray-100 shadow-sm transition-all duration-500 hover:shadow-2xl flex flex-col">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center">
                        <i class="fas fa-list-ol"></i>
                    </div>
                    <h3 class="text-2xl font-black text-gray-800 tracking-tight">ประวัติคะแนน</h3>
                </div>

                <div class="space-y-4 overflow-y-auto pr-2 custom-scrollbar flex-1 max-h-[400px]">
                    @forelse($submissions as $submission)
                        @if($submission->score !== null)
                            <div
                                class="group p-4 bg-gray-50/50 rounded-[1.5rem] border border-gray-100 hover:bg-white hover:border-primary-100 hover:shadow-xl hover:shadow-primary-500/5 transition-all">
                                <div class="flex items-center justify-between gap-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-xl bg-white text-gray-400 flex items-center justify-center border border-gray-100 text-xs font-black shadow-sm group-hover:bg-primary-500 group-hover:text-white group-hover:border-primary-500 transition-all">
                                            {{ $loop->iteration }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-black text-gray-800 line-clamp-1 tracking-tight">
                                                {{ $submission->assignment->title }}</p>
                                            <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">
                                                {{ $submission->updated_at->format('d M Y') }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span
                                            class="text-lg font-black text-primary-600 block leading-none">{{ $submission->score }}</span>
                                        <span
                                            class="text-[9px] font-bold text-gray-400 tracking-widest italic">/{{ $submission->assignment->max_score }}</span>
                                    </div>
                                </div>
                                @if($submission->feedback)
                                    <div
                                        class="mt-3 p-3 bg-amber-50/50 rounded-xl border border-amber-100/50 text-[10px] font-bold text-amber-700 italic flex gap-2">
                                        <i class="fas fa-comment-dots mt-0.5"></i>
                                        <span class="line-clamp-2">{{ $submission->feedback }}</span>
                                    </div>
                                @endif
                            </div>
                        @endif
                    @empty
                        <div class="flex flex-col items-center justify-center py-12 opacity-30">
                            <i class="fas fa-history text-3xl mb-2"></i>
                            <p class="font-black text-[10px] uppercase tracking-widest">ยังไม่มีคะแนน</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Achievement Badges (Premium) -->
        <div class="bg-gray-900 rounded-[3rem] p-10 md:p-12 shadow-2xl relative overflow-hidden group">
            <div class="absolute inset-0 bg-gradient-to-br from-primary-600/10 via-amber-600/5 to-transparent"></div>
            <div
                class="absolute -right-20 top-0 w-80 h-80 bg-primary-500/10 rounded-full blur-[100px] group-hover:scale-125 transition-transform duration-1000">
            </div>

            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8 mb-12">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <i class="fas fa-award text-amber-400 text-2xl"></i>
                        <h2 class="text-2xl font-black text-white tracking-widest uppercase">ความสำเร็จของฉัน</h2>
                    </div>
                    <p class="text-gray-400 font-medium">ทำภารกิจและเลื่อนระดับเพื่อรับเข็มกลัดเกียรติยศ</p>
                </div>
            </div>

            <div class="relative z-10 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8">
                @php
                    $badges = [
                        ['id' => 'ontime', 'label' => 'ส่งงานจอมพลัง', 'desc' => 'ส่งงานตรงเวลา 5 ครั้งติดต่อกัน', 'icon' => 'fa-fire', 'color' => 'amber', 'active' => true],
                        ['id' => 'highscore', 'label' => 'ยอดพิมพ์มือหนึ่ง', 'desc' => 'คะแนนสูงกว่า 90 ต่อเนื่อง 3 งาน', 'icon' => 'fa-star', 'color' => 'indigo', 'active' => true],
                        ['id' => 'fast', 'label' => 'ก้าวกระโดด', 'desc' => 'พัฒนาความเร็วอย่างต่อเนื่อง', 'icon' => 'fa-rocket', 'color' => 'primary', 'active' => true],
                        ['id' => 'perfect', 'label' => 'Full Marks', 'desc' => 'ทำคะแนนเต็มในบทเรียนทั่วไป', 'icon' => 'fa-bullseye', 'color' => 'red', 'active' => false],
                        ['id' => 'rank1', 'label' => 'Top Ranker', 'desc' => 'ขึ้นสู่อันดับ 1 ของชั้นเรียน', 'icon' => 'fa-crown', 'color' => 'yellow', 'active' => false],
                        ['id' => 'completist', 'label' => 'พิชิตทุกบท', 'desc' => 'ส่งงานครบ 100% ในเทอมนี้', 'icon' => 'fa-check-double', 'color' => 'emerald', 'active' => false],
                    ];
                @endphp

                @foreach($badges as $b)
                    <div class="group/item text-center">
                        <div class="relative mb-4 inline-block">
                            @if($b['active'])
                                <div
                                    class="absolute inset-0 bg-{{ $b['color'] }}-500 rounded-full blur-xl opacity-20 group-hover/item:opacity-40 transition-opacity">
                                </div>
                            @endif
                            <div
                                class="w-20 h-20 mx-auto rounded-3xl {{ $b['active'] ? 'bg-gradient-to-br from-' . $b['color'] . '-400 to-' . $b['color'] . '-600 shadow-2xl' : 'bg-white/5 border border-white/10 grayscale opacity-40' }} flex items-center justify-center transform group-hover/item:scale-110 group-hover/item:rotate-6 transition-all duration-500 relative">
                                <i
                                    class="fas {{ $b['icon'] }} text-3xl {{ $b['active'] ? 'text-white' : 'text-gray-500' }}"></i>
                                @if(!$b['active'])
                                    <div
                                        class="absolute top-1 right-1 w-5 h-5 bg-gray-800 rounded-full border-2 border-gray-700 flex items-center justify-center">
                                        <i class="fas fa-lock text-[8px] text-gray-500"></i>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <h4
                            class="text-xs font-black {{ $b['active'] ? 'text-white' : 'text-gray-600' }} uppercase tracking-widest mb-1">
                            {{ $b['label'] }}</h4>
                        <p class="text-[9px] font-medium text-gray-500 leading-tight">{{ $b['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <style>
        .animate-pulse-slow {
            animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 0.8;
            }

            50% {
                opacity: 0.4;
            }
        }

        @keyframes shimmer {
            0% {
                opacity: 0.1;
                transform: translateX(-100%) skewX(-15deg);
            }

            50% {
                opacity: 0.3;
            }

            100% {
                opacity: 0.1;
                transform: translateX(200%) skewX(-15deg);
            }
        }

        .animate-shimmer {
            animation: shimmer 2s infinite ease-in-out;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e5e7eb;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #d1d5db;
        }
    </style>
</x-typing-app>