<x-typing-app :role="auth()->user()->role" :title="'การแข่งขัน - ระบบวิชาพิมพ์หนังสือราชการ 1'">
    <div class="space-y-10 pb-12">

        <!-- Aurora & Glass Header -->
        <div
            class="relative overflow-hidden bg-white border border-white/40 rounded-[2.5rem] p-8 md:p-10 shadow-2xl group transition-all duration-500 hover:shadow-amber-500/10">
            <!-- Aurora Background -->
            <div class="absolute inset-0 bg-gradient-to-br from-white via-amber-50/30 to-orange-50/20 opacity-80"></div>
            <div
                class="absolute top-[-30%] right-[-10%] w-[600px] h-[600px] bg-gradient-to-br from-amber-300/10 via-orange-300/10 to-yellow-200/10 rounded-full blur-[80px] animate-pulse-slow pointer-events-none mix-blend-multiply">
            </div>
            <div
                class="absolute bottom-[-20%] left-[-10%] w-[500px] h-[500px] bg-gradient-to-tr from-orange-200/10 via-amber-200/10 to-primary-200/10 rounded-full blur-[80px] animate-pulse-slow delay-1000 pointer-events-none mix-blend-multiply">
            </div>

            <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-8">
                <div class="flex items-center gap-6">
                    <div
                        class="w-20 h-20 rounded-[2rem] bg-gradient-to-br from-amber-400 to-orange-600 text-white flex items-center justify-center shadow-2xl shadow-amber-500/30 transform group-hover:rotate-12 transition-all duration-500">
                        <i class="fas fa-trophy text-4xl"></i>
                    </div>
                    <div>
                        <h1 class="text-4xl md:text-5xl font-black text-gray-800 tracking-tight">การแข่งขัน</h1>
                        <p class="text-gray-500 mt-2 font-medium flex items-center gap-2 text-lg">
                            <span class="w-3 h-3 rounded-full bg-amber-500 animate-ping"></span>
                            Tournament & Hall of Fame
                        </p>
                    </div>
                </div>

                @if(Auth::user()->role === 'admin' || Auth::user()->role === 'teacher')
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('typing.tournaments.create', ['type' => 'bracket']) }}"
                            class="group/btn flex items-center gap-3 px-8 py-4 rounded-2xl bg-amber-500 text-white font-black hover:bg-amber-600 hover:shadow-2xl hover:-translate-y-1 transition-all shadow-xl shadow-amber-500/20 overflow-hidden relative">
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 translate-x-[-100%] group-hover/btn:translate-x-[100%] transition-transform duration-1000">
                            </div>
                            <i class="fas fa-sitemap transition-transform group-hover/btn:scale-120"></i>
                            สร้าง Bracket
                        </a>
                        <a href="{{ route('typing.tournaments.create', ['type' => 'class_battle']) }}"
                            class="group/btn flex items-center gap-3 px-8 py-4 rounded-2xl bg-indigo-600 text-white font-black hover:bg-indigo-700 hover:shadow-2xl hover:-translate-y-1 transition-all shadow-xl shadow-indigo-500/20 overflow-hidden relative">
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 translate-x-[-100%] group-hover/btn:translate-x-[100%] transition-transform duration-1000">
                            </div>
                            <i class="fas fa-users-class transition-transform group-hover/btn:scale-120"></i>
                            สร้างห้อง Classroom
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Tournament Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($tournaments as $tournament)
                <div
                    class="group relative bg-white rounded-[3rem] p-8 shadow-xl border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 overflow-hidden">
                    <!-- Glassmorphism Card Style -->
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-amber-50 to-transparent -mr-16 -mt-16 rounded-full opacity-50">
                    </div>

                    <!-- Content -->
                    <div class="relative z-10">
                        <div class="flex justify-between items-start mb-6">
                            @if($tournament->type === 'class_battle')
                                <div
                                    class="px-3 py-1.5 rounded-xl bg-indigo-50 text-indigo-600 text-[10px] font-black uppercase tracking-widest border border-indigo-100">
                                    <i class="fas fa-users-class mr-1"></i> Classroom Battle
                                </div>
                            @else
                                <div
                                    class="px-3 py-1.5 rounded-xl bg-amber-50 text-amber-600 text-[10px] font-black uppercase tracking-widest border border-amber-100">
                                    <i class="fas fa-sitemap mr-1"></i> Bracket System
                                </div>
                            @endif

                            <div class="flex items-center">
                                @if($tournament->status === 'open')
                                    <span class="flex h-3 w-3 relative mr-2">
                                        <span
                                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                                    </span>
                                    <span
                                        class="text-[10px] font-black text-emerald-600 uppercase tracking-tighter">เปิดรับสมัคร</span>
                                @elseif($tournament->status === 'ongoing')
                                    <span class="flex h-3 w-3 relative mr-2">
                                        <span
                                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-3 w-3 bg-blue-500"></span>
                                    </span>
                                    <span
                                        class="text-[10px] font-black text-blue-600 uppercase tracking-tighter">กำลังแข่งขัน</span>
                                @else
                                    <span
                                        class="text-[10px] font-black text-gray-400 uppercase tracking-tighter">จบการแข่งขันแล้ว</span>
                                @endif
                            </div>
                        </div>

                        <h2
                            class="text-2xl font-black text-gray-800 mb-2 leading-tight group-hover:text-primary-600 transition-colors">
                            {{ $tournament->name }}
                        </h2>
                        <p class="text-sm font-medium text-gray-400 line-clamp-2 mb-8 h-10">
                            {{ $tournament->description ?: 'ไม่มีรายละเอียดกิจกรรม' }}
                        </p>

                        <!-- Bento-ish Stats Row -->
                        <div class="grid grid-cols-2 gap-4 mb-8">
                            <div
                                class="bg-gray-50 rounded-2xl p-4 border border-gray-100 flex flex-col items-center text-center">
                                <i class="fas fa-users text-primary-500 text-lg mb-1"></i>
                                <span class="text-lg font-black text-gray-800">{{ $tournament->participants_count }}</span>
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">ผู้เข้าร่วม
                                    ({{ $tournament->max_participants }})</span>
                            </div>
                            <div
                                class="bg-gray-50 rounded-2xl p-4 border border-gray-100 flex flex-col items-center text-center">
                                <i class="fas fa-calendar-alt text-secondary-500 text-lg mb-1"></i>
                                <span
                                    class="text-lg font-black text-gray-800">{{ $tournament->created_at->format('d M') }}</span>
                                <span
                                    class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ $tournament->created_at->format('Y') }}</span>
                            </div>
                        </div>

                        <!-- Progress Section -->
                        @php
                            $progress = $tournament->max_participants > 0 ? ($tournament->participants_count / $tournament->max_participants) * 100 : 0;
                            $pColor = $progress >= 100 ? 'from-amber-500 to-orange-600' : 'from-primary-500 to-indigo-600';
                        @endphp
                        <div class="mb-8">
                            <div class="flex justify-between items-end mb-2">
                                <span
                                    class="text-[10px] font-black text-gray-400 uppercase tracking-widest">ความหนาแน่นผู้สมัคร</span>
                                <span class="text-xs font-black text-gray-800">{{ number_format($progress, 0) }}%</span>
                            </div>
                            <div class="h-4 w-full bg-gray-100 rounded-full overflow-hidden p-1 shadow-inner">
                                <div class="h-full rounded-full bg-gradient-to-r {{ $pColor }} transition-all duration-1000"
                                    style="width: {{ $progress }}%"></div>
                            </div>
                        </div>

                        <!-- Main Actions -->
                        <div class="space-y-3">
                            <a href="{{ route('typing.tournaments.show', $tournament->id) }}"
                                class="flex items-center justify-center gap-2 w-full py-4 rounded-2xl bg-gray-50 text-gray-600 font-black hover:bg-primary-500 hover:text-white transition-all shadow-sm border border-gray-100 hover:border-primary-500 hover:shadow-lg hover:shadow-primary-500/20">
                                <i class="fas fa-door-open"></i>
                                เข้าสู่ห้องแข่งขัน
                            </a>

                            @if((Auth::user()->role === 'admin' || Auth::user()->role === 'teacher') && $tournament->status !== 'completed')
                                <div class="flex gap-2">
                                    @if($tournament->status === 'open')
                                        <form action="{{ route('typing.tournaments.start', $tournament->id) }}" method="POST"
                                            class="flex-1">
                                            @csrf
                                            <button type="submit"
                                                class="w-full flex items-center justify-center gap-2 py-3 rounded-xl bg-emerald-50 text-emerald-600 font-black hover:bg-emerald-500 hover:text-white transition-all border border-emerald-100 shadow-sm">
                                                <i class="fas fa-play text-xs"></i>
                                                เริ่มทันที
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('typing.tournaments.destroy', $tournament->id) }}" method="POST"
                                        onsubmit="return confirm('ยืนยันลบการแข่งขันนี้? ข้อมูลทั้งหมดจะหายไป');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-3 rounded-xl bg-red-50 text-red-400 hover:bg-red-500 hover:text-white transition-all border border-red-50 border-red-100 shadow-sm">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            @elseif((Auth::user()->role === 'admin' || Auth::user()->role === 'teacher'))
                                <form action="{{ route('typing.tournaments.destroy', $tournament->id) }}" method="POST"
                                    onsubmit="return confirm('ยืนยันลบการแข่งขันนี้? ข้อมูลทั้งหมดจะหายไป');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-full text-[10px] font-black text-gray-400 uppercase tracking-widest hover:text-red-500 transition-colors py-2">
                                        ลบประวัติการแข่งขัน
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div
                        class="bg-white rounded-[3rem] p-16 text-center border-2 border-dashed border-gray-100 shadow-2xl shadow-gray-200/50">
                        <div
                            class="w-24 h-24 bg-gray-50 rounded-[2rem] flex items-center justify-center mx-auto mb-6 text-gray-300">
                            <i class="fas fa-trophy text-4xl"></i>
                        </div>
                        <h3 class="text-3xl font-black text-gray-800 mb-2 tracking-tight">ไม่มีกิจกรรมการแข่งขัน</h3>
                        <p class="text-gray-500 font-medium text-lg">ขณะนี้ระบบยังไม่มีการสร้างห้องแข่งขัน <br>
                            รอการท้าทายจากคุณครูเร็วๆ นี้!</p>
                    </div>
                </div>
                @forelse($tournaments as $tournament)
                    {{-- Content handled above --}}
                @empty
                    {{-- Handle already covered --}}
                @endforelse
            @endforelse
        </div>
    </div>

    <style>
        .animate-pulse-slow {
            animation: pulse 8s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 0.2;
                transform: scale(1);
            }

            50% {
                opacity: 0.4;
                transform: scale(1.1);
            }
        }
    </style>
</x-typing-app>