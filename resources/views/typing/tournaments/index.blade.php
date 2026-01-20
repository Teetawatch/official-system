<x-typing-app :role="auth()->user()->role" :title="'การแข่งขัน - ระบบวิชาพิมพ์หนังสือราชการ 1'">

    <!-- Page Header -->
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">
                <i class="fas fa-trophy text-amber-500 mr-2"></i>
                🏆 การแข่งขัน
            </h1>
            <p class="text-gray-500 mt-1">ร่วมแข่งขันพิมพ์ดีดกับผู้เล่นคนอื่นๆ</p>
        </div>

        @if(Auth::user()->role === 'admin' || Auth::user()->role === 'teacher')
            <a href="{{ route('typing.tournaments.create') }}" class="btn-primary inline-flex items-center gap-2">
                <i class="fas fa-plus"></i>
                สร้างการแข่งขัน
            </a>
        @endif
    </div>

    <!-- Tournament Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($tournaments as $tournament)
            <div class="card group hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="p-6">
                    <!-- Header -->
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex-1">
                            <h2 class="text-xl font-bold text-gray-800 group-hover:text-primary-600 transition-colors">
                                {{ $tournament->name }}
                            </h2>
                            <p class="text-gray-500 text-sm mt-1 line-clamp-2">
                                {{ $tournament->description }}
                            </p>
                        </div>
                        <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                @if($tournament->status === 'open')
                                    bg-green-100 text-green-800
                                @elseif($tournament->status === 'ongoing')
                                    bg-blue-100 text-blue-800
                                @else
                                    bg-gray-100 text-gray-800
                                @endif
                            ">
                            @if($tournament->status === 'open')
                                <i class="fas fa-door-open mr-1"></i> เปิดรับสมัคร
                            @elseif($tournament->status === 'ongoing')
                                <i class="fas fa-play mr-1"></i> กำลังแข่งขัน
                            @else
                                <i class="fas fa-flag-checkered mr-1"></i> จบแล้ว
                            @endif
                        </span>
                    </div>

                    <!-- Stats -->
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4 pb-4 border-b border-gray-100">
                        <span class="flex items-center gap-2">
                            <i class="fas fa-users text-primary-500"></i>
                            <span class="font-medium text-gray-700">{{ $tournament->participants_count }}</span> /
                            {{ $tournament->max_participants }} คน
                        </span>
                        <span class="flex items-center gap-2">
                            <i class="fas fa-calendar text-secondary-500"></i>
                            {{ $tournament->created_at->format('d M Y') }}
                        </span>
                    </div>

                    <!-- Progress Bar -->
                    @php
                        $progress = $tournament->max_participants > 0 ? ($tournament->participants_count / $tournament->max_participants) * 100 : 0;
                    @endphp
                    <div class="mb-4">
                        <div class="flex justify-between text-xs text-gray-500 mb-1">
                            <span>ผู้เข้าร่วม</span>
                            <span>{{ number_format($progress, 0) }}%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-gradient-to-r from-primary-500 to-secondary-500"
                                style="width: {{ $progress }}%"></div>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <a href="{{ route('typing.tournaments.show', $tournament->id) }}"
                        class="btn-secondary w-full text-center flex items-center justify-center gap-2">
                        <i class="fas fa-eye"></i>
                        ดู Bracket
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="card text-center py-16">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-trophy text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">ยังไม่มีการแข่งขัน</h3>
                    <p class="text-gray-500">รอติดตามการแข่งขันครั้งถัดไปได้เลย!</p>
                </div>
            </div>
        @endforelse
    </div>

</x-typing-app>