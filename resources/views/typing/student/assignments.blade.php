<x-typing-app :role="'student'" :title="'งานที่ได้รับ - ระบบวิชาพิมพ์หนังสือราชการ 1'">
    <div class="space-y-10 pb-12">
        
        <!-- Aurora & Glass Header -->
        <div class="relative overflow-hidden bg-white border border-white/40 rounded-[2.5rem] p-8 md:p-10 shadow-2xl group transition-all duration-500 hover:shadow-primary-500/10">
            <!-- Aurora Background -->
            <div class="absolute inset-0 bg-gradient-to-br from-white via-primary-50/30 to-indigo-50/20 opacity-80"></div>
            <div class="absolute top-[-30%] right-[-10%] w-[600px] h-[600px] bg-gradient-to-br from-primary-300/10 via-indigo-300/10 to-purple-200/10 rounded-full blur-[80px] animate-pulse-slow pointer-events-none mix-blend-multiply"></div>
            
            <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-8">
                <div class="flex items-center gap-6">
                    <div class="w-20 h-20 rounded-[2rem] bg-gradient-to-br from-primary-500 to-indigo-600 text-white flex items-center justify-center shadow-2xl transform group-hover:rotate-6 transition-all duration-500">
                        <i class="fas fa-clipboard-list text-4xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl md:text-4xl font-black text-gray-800 tracking-tight mb-2">งานที่ได้รับ</h1>
                        <p class="text-gray-500 font-medium text-lg flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-primary-500"></span>
                            ดูรายการงานพิมพ์ทั้งหมดที่คุณได้รับมอบหมาย
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-4 bg-white/50 backdrop-blur-md p-2 rounded-2xl border border-white/50">
                    <div class="px-4 py-2">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1 text-center">FILTER</p>
                        <select class="bg-transparent border-none font-bold text-gray-800 focus:ring-0 cursor-pointer">
                            <option value="">สถานะทั้งหมด</option>
                            <option value="pending">รอส่งงาน</option>
                            <option value="submitted">ส่งแล้ว</option>
                            <option value="graded">ตรวจแล้ว</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Bento Grid -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $statsItems = [
                    ['label' => 'งานทั้งหมด', 'value' => $totalAssignments, 'icon' => 'fa-list-check', 'color' => 'from-indigo-500 to-blue-600', 'bg' => 'bg-indigo-50'],
                    ['label' => 'รอส่งงาน', 'value' => max(0, $pendingCount), 'icon' => 'fa-clock', 'color' => 'from-amber-400 to-orange-500', 'bg' => 'bg-amber-50'],
                    ['label' => 'กำลังรอตรวจ', 'value' => $waitingGrade, 'icon' => 'fa-paper-plane', 'color' => 'from-blue-400 to-cyan-500', 'bg' => 'bg-blue-50'],
                    ['label' => 'ให้คะแนนแล้ว', 'value' => $gradedCount, 'icon' => 'fa-check-circle', 'color' => 'from-emerald-400 to-teal-600', 'bg' => 'bg-emerald-50'],
                ];
            @endphp

            @foreach($statsItems as $stat)
                <div class="group relative overflow-hidden bg-white rounded-3xl p-6 border border-gray-100 shadow-sm transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br {{ $stat['color'] }} opacity-[0.03] rounded-bl-[4rem] group-hover:scale-110 transition-transform"></div>
                    <div class="relative z-10 flex items-center gap-5">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br {{ $stat['color'] }} text-white flex items-center justify-center shadow-lg group-hover:rotate-6 transition-all">
                            <i class="fas {{ $stat['icon'] }} text-xl"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-1">{{ $stat['label'] }}</p>
                            <p class="text-3xl font-black text-gray-800 tracking-tighter">{{ number_format($stat['value']) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Assignments List Grouped -->
        <div class="space-y-12">
            @forelse($assignments->groupBy('chapter') as $chapter => $chapterAssignments)
                @php
                    $chapterTitle = $chapter ?: 'บทเรียนทั่วไป';
                @endphp
                <div class="relative">
                    <!-- Chapter Label -->
                    <div class="flex items-center gap-4 mb-8">
                        <div class="h-px flex-1 bg-gradient-to-r from-transparent via-gray-200 to-transparent"></div>
                        <h3 class="px-8 py-2 rounded-full bg-white border border-gray-100 shadow-sm text-sm font-black text-gray-800 uppercase tracking-[0.3em]">
                            {{ $chapterTitle }}
                        </h3>
                        <div class="h-px flex-1 bg-gradient-to-r from-transparent via-gray-200 to-transparent"></div>
                    </div>

                    <div class="grid grid-cols-1 gap-6">
                        @foreach($chapterAssignments as $assignment)
                            @php
                                $submission = $assignment->submissions->first();
                                $status = 'pending';
                                if ($submission) {
                                    $status = $submission->score !== null ? 'graded' : 'submitted';
                                }

                                $isExpired = $status == 'pending' && $assignment->due_date && now()->greaterThan($assignment->due_date);
                                $isUrgent = !$isExpired && $status == 'pending' && $assignment->due_date && $assignment->due_date->isFuture() && $assignment->due_date->diffInDays(now()) <= 2;

                                $theme = match($status) {
                                    'graded' => [
                                        'color' => 'emerald', 
                                        'badge' => 'ตรวจแล้ว', 
                                        'icon' => 'fa-check-circle',
                                        'bg' => 'from-emerald-500 to-teal-600',
                                        'glow' => 'shadow-emerald-500/10'
                                    ],
                                    'submitted' => [
                                        'color' => 'blue', 
                                        'badge' => 'ส่งแล้ว', 
                                        'icon' => 'fa-hourglass-half',
                                        'bg' => 'from-blue-500 to-indigo-600',
                                        'glow' => 'shadow-blue-500/10'
                                    ],
                                    default => $isExpired ? [
                                        'color' => 'gray', 
                                        'badge' => 'หมดเขต', 
                                        'icon' => 'fa-lock',
                                        'bg' => 'from-gray-400 to-gray-500',
                                        'glow' => 'shadow-gray-500/10'
                                    ] : ($isUrgent ? [
                                        'color' => 'red', 
                                        'badge' => 'ด่วน!', 
                                        'icon' => 'fa-fire',
                                        'bg' => 'from-red-500 to-orange-600',
                                        'glow' => 'shadow-red-500/10'
                                    ] : [
                                        'color' => 'amber', 
                                        'badge' => 'รอส่งงาน', 
                                        'icon' => 'fa-file-alt',
                                        'bg' => 'from-amber-400 to-orange-500',
                                        'glow' => 'shadow-amber-500/10'
                                    ])
                                };
                            @endphp

                            <div class="group relative bg-white rounded-[2.5rem] border border-gray-100 shadow-sm transition-all duration-500 hover:shadow-2xl hover:-translate-y-1 overflow-hidden {{ $isExpired ? 'opacity-80' : '' }}">
                                <!-- Glow Background -->
                                <div class="absolute inset-0 bg-gradient-to-br from-white via-transparent to-{{ $theme['color'] }}-50/30 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                
                                <div class="relative z-10 p-6 md:p-8 flex flex-col md:flex-row md:items-center justify-between gap-8">
                                    <div class="flex items-center gap-6">
                                        <!-- Status Icon -->
                                        <div class="relative shrink-0">
                                            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br {{ $theme['bg'] }} text-white flex items-center justify-center shadow-xl {{ $theme['glow'] }} group-hover:rotate-6 transition-all duration-500">
                                                <i class="fas {{ $theme['icon'] }} text-2xl"></i>
                                            </div>
                                            @if($isUrgent)
                                                <div class="absolute -top-2 -right-2 w-6 h-6 rounded-full bg-red-500 border-2 border-white animate-ping"></div>
                                                <div class="absolute -top-2 -right-2 w-6 h-6 rounded-full bg-red-500 border-2 border-white flex items-center justify-center">
                                                    <i class="fas fa-exclamation text-[10px] text-white"></i>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="space-y-1">
                                            <div class="flex items-center gap-3">
                                                <h4 class="text-xl font-black text-gray-800 tracking-tight group-hover:text-primary-600 transition-colors">{{ $assignment->title }}</h4>
                                                <span class="px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest leading-none bg-{{ $theme['color'] }}-100 text-{{ $theme['color'] }}-600 border border-{{ $theme['color'] }}-200">
                                                    {{ $theme['badge'] }}
                                                </span>
                                            </div>
                                            <p class="text-sm text-gray-500 font-medium line-clamp-1 max-w-xl">{{ Str::limit($assignment->content, 120) }}</p>
                                            
                                            <div class="flex flex-wrap items-center gap-4 mt-3">
                                                <div class="flex items-center gap-1.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                                                    <i class="fas fa-star text-amber-400"></i>
                                                    <span class="text-gray-600">{{ $assignment->max_score }} คะแนนเต็ม</span>
                                                </div>
                                                @if($assignment->time_limit)
                                                    <div class="flex items-center gap-1.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                                                        <i class="fas fa-stopwatch text-indigo-400"></i>
                                                        <span class="text-gray-600">{{ $assignment->time_limit }} MINS</span>
                                                    </div>
                                                @endif
                                                @if($status == 'graded')
                                                    <div class="flex items-center gap-1.5 text-[11px] font-bold text-emerald-500 uppercase tracking-wider">
                                                        <i class="fas fa-trophy"></i>
                                                        <span>SCORED: {{ $submission->score }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Action Side -->
                                    <div class="flex flex-col md:items-end gap-3 shrink-0">
                                        @if($assignment->due_date)
                                            <div class="flex flex-col items-end px-4 py-2 bg-gray-50 rounded-2xl border border-gray-100">
                                                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1">Due Date</p>
                                                <p class="text-sm font-black {{ $isExpired ? 'text-red-500' : ($isUrgent ? 'text-orange-500' : 'text-gray-700') }}">
                                                    {{ $assignment->due_date->format('d M Y') }} 
                                                    <span class="text-[10px] opacity-60 ml-1">{{ $assignment->due_date->format('H:i') }}</span>
                                                </p>
                                            </div>
                                        @endif

                                        <div class="flex items-center gap-2">
                                            @if($status == 'pending')
                                                @if($isExpired)
                                                    <div class="px-8 py-3 bg-gray-100 text-gray-400 font-black rounded-2xl border border-gray-200 cursor-not-allowed">
                                                        <i class="fas fa-lock mr-2"></i>
                                                        EXPIRED
                                                    </div>
                                                @else
                                                    <a href="{{ $assignment->submission_type === 'file' ? route('typing.student.upload', $assignment->id) : route('typing.student.practice', $assignment->id) }}" 
                                                       class="group/btn relative overflow-hidden px-8 py-3 bg-primary-500 text-white font-black rounded-2xl hover:bg-primary-600 hover:shadow-xl hover:-translate-y-1 transition-all">
                                                        <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/10 to-white/0 translate-x-[-100%] group-hover/btn:translate-x-[100%] transition-transform duration-700"></div>
                                                        <i class="fas {{ $assignment->submission_type === 'file' ? 'fa-file-upload' : 'fa-keyboard' }} mr-2 transition-transform group-hover/btn:scale-110"></i>
                                                        {{ $assignment->submission_type === 'file' ? 'อัปโหลดงาน' : 'เริ่มพิมพ์' }}
                                                    </a>
                                                @endif
                                            @else
                                                <a href="{{ route('typing.student.submissions.show', $submission->id) }}" 
                                                   class="px-8 py-3 bg-white text-gray-800 font-black rounded-2xl border border-gray-200 hover:bg-gray-50 transition-all flex items-center gap-2">
                                                    <i class="fas fa-eye text-primary-500"></i>
                                                    รายละเอียดงาน
                                                </a>
                                                @if($status == 'graded')
                                                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center border border-emerald-100 hover:scale-110 transition-transform cursor-help group/tip relative">
                                                        <i class="fas fa-comment-dots text-lg"></i>
                                                        <div class="absolute bottom-full right-0 mb-2 px-3 py-2 bg-gray-900 text-white text-[10px] rounded-xl opacity-0 group-hover/tip:opacity-100 transition-opacity whitespace-nowrap shadow-2xl pointer-events-none">View Feedback</div>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="py-24 text-center">
                    <div class="w-32 h-32 bg-gray-50 rounded-[4rem] flex items-center justify-center mx-auto mb-6 text-gray-300 transform -rotate-12 border-2 border-dashed border-gray-200">
                        <i class="fas fa-clipboard-check text-5xl"></i>
                    </div>
                    <h3 class="text-3xl font-black text-gray-400 uppercase tracking-widest">ยินดีด้วย! คุณส่งงานครบแล้ว</h3>
                    <p class="text-gray-500 font-medium mt-2">ขยันฝึกซ้อมแบบนี้ รับรองเกรดเอแน่นอน</p>
                </div>
            @endforelse
        </div>
    </div>

    <style>
        .animate-pulse-slow { animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
        @keyframes pulse { 0%, 100% { opacity: 0.8; } 50% { opacity: 0.4; } }
    </style>
</x-typing-app>