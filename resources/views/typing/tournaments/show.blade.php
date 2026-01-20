<x-typing-app :role="auth()->user()->role" :title="$tournament->name . ' - ระบบวิชาพิมพ์หนังสือราชการ 1'">
    
    <!-- Page Header -->
    <div class="card mb-8">
        <div class="p-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <a href="{{ route('typing.tournaments.index') }}" class="text-gray-400 hover:text-primary-500 transition-colors">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800">{{ $tournament->name }}</h1>
                </div>
                <p class="text-gray-500">{{ $tournament->description }}</p>
                
                <div class="mt-4 flex flex-wrap items-center gap-4">
                    <span class="px-3 py-1 rounded-full text-sm font-medium
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
                    <span class="text-sm text-gray-500">
                        <i class="fas fa-users mr-1"></i>
                        ผู้เข้าร่วม: {{ $tournament->participants->count() }} / {{ $tournament->max_participants }} คน
                    </span>
                </div>
            </div>
            
            <div class="flex flex-wrap gap-3">
                @if($tournament->status === 'open')
                    @if(!$tournament->participants->contains(Auth::id()))
                        <form action="{{ route('typing.tournaments.join', $tournament->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-primary">
                                <i class="fas fa-sign-in-alt mr-2"></i>
                                เข้าร่วมการแข่งขัน
                            </button>
                        </form>
                    @else
                        <button disabled class="btn-secondary opacity-75 cursor-not-allowed">
                            <i class="fas fa-check mr-2"></i>
                            เข้าร่วมแล้ว
                        </button>
                    @endif
                @endif
            </div>
        </div>
    </div>

    <!-- Bracket Visualization -->
    <div class="card">
        <div class="p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6">
                <i class="fas fa-sitemap text-primary-500 mr-2"></i>
                สาย Bracket
            </h2>
            
            <div class="overflow-x-auto pb-12">
                <div class="min-w-max flex gap-8 lg:gap-16 px-4">
                    @php
                        $rounds = [1 => 'รอบ 16 คน', 2 => 'รอบ 8 คน', 3 => 'รอบรองชนะเลิศ', 4 => 'รอบชิงชนะเลิศ'];
                        $matchCounts = [1 => 8, 2 => 4, 3 => 2, 4 => 1];
                    @endphp

                    @foreach($rounds as $roundNum => $roundName)
                        <div class="flex flex-col justify-around gap-4 lg:gap-8">
                            <h3 class="text-center text-sm lg:text-lg font-bold text-gray-500 mb-4 sticky top-0 bg-white py-2 rounded-lg shadow-sm">
                                {{ $roundName }}
                            </h3>
                            
                            @for($i = 0; $i < $matchCounts[$roundNum]; $i++)
                                @php
                                    $match = $matchesByRound->get($roundNum)?->firstWhere('bracket_index', $i);
                                @endphp
                                
                                <div class="w-56 lg:w-64 bg-white border-2 rounded-xl shadow-sm p-4 relative flex flex-col justify-center gap-2 transition-all hover:shadow-md
                                    @if($match)
                                        @if($match->status == 'completed')
                                            border-green-400 bg-green-50
                                        @else
                                            border-primary-400
                                        @endif
                                    @else
                                        border-gray-200 border-dashed
                                    @endif
                                " style="min-height: 100px;">
                                    
                                    @if($match)
                                        <!-- Player 1 -->
                                        <div class="flex justify-between items-center p-2 rounded-lg 
                                            {{ $match->winner_id == $match->player1_id ? 'bg-green-100 font-bold text-green-700' : '' }}">
                                            <span class="truncate flex items-center gap-2">
                                                @if($match->player1)
                                                    <img src="{{ $match->player1->avatar_url }}" class="w-6 h-6 rounded-full object-cover border border-gray-200">
                                                    <span class="truncate">{{ $match->player1->name }}</span>
                                                @else
                                                    <span class="text-gray-400 italic">รอผู้เล่น...</span>
                                                @endif
                                            </span>
                                            @if($match->player1_wpm)
                                                <span class="text-xs bg-gray-100 px-2 py-1 rounded font-medium">{{ $match->player1_wpm }} WPM</span>
                                            @endif
                                        </div>

                                        <div class="h-px bg-gray-200 w-full"></div>

                                        <!-- Player 2 -->
                                        <div class="flex justify-between items-center p-2 rounded-lg
                                            {{ $match->winner_id == $match->player2_id ? 'bg-green-100 font-bold text-green-700' : '' }}">
                                            <span class="truncate flex items-center gap-2">
                                                @if($match->player2)
                                                    <img src="{{ $match->player2->avatar_url }}" class="w-6 h-6 rounded-full object-cover border border-gray-200">
                                                    <span class="truncate">{{ $match->player2->name }}</span>
                                                @else
                                                    <span class="text-gray-400 italic">รอผู้เล่น...</span>
                                                @endif
                                            </span>
                                            @if($match->player2_wpm)
                                                <span class="text-xs bg-gray-100 px-2 py-1 rounded font-medium">{{ $match->player2_wpm }} WPM</span>
                                            @endif
                                        </div>

                                        <!-- Match Action -->
                                        @if($match->status !== 'completed')
                                            @if(Auth::id() == $match->player1_id || Auth::id() == $match->player2_id)
                                                <a href="{{ route('typing.student.matches.show', $match->id) }}" 
                                                   class="absolute -right-3 -top-3 w-10 h-10 bg-gradient-to-r from-red-500 to-orange-500 hover:from-red-600 hover:to-orange-600 text-white rounded-full flex items-center justify-center shadow-lg transform hover:scale-110 transition-all" 
                                                   title="เริ่มแข่ง">
                                                    <i class="fas fa-play"></i>
                                                </a>
                                            @endif
                                        @else
                                            <div class="absolute -right-2 -top-2 w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center shadow-md">
                                                <i class="fas fa-check text-sm"></i>
                                            </div>
                                        @endif
                                    @else
                                        <div class="text-center text-gray-400 text-sm italic py-2">
                                            <i class="fas fa-clock mr-1"></i>
                                            รอผลการแข่งขัน
                                        </div>
                                    @endif
                                </div>
                            @endfor
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Participants List -->
    @if($tournament->participants->count() > 0)
    <div class="card mt-6">
        <div class="p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">
                <i class="fas fa-users text-secondary-500 mr-2"></i>
                ผู้เข้าร่วมการแข่งขัน
            </h2>
            
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach($tournament->participants as $participant)
                    <div class="text-center p-3 rounded-xl bg-gray-50 hover:bg-primary-50 transition-colors">
                        <img src="{{ $participant->avatar_url }}" class="w-12 h-12 rounded-full mx-auto mb-2 object-cover border-2 border-gray-200">
                        <p class="font-medium text-gray-800 text-sm truncate">{{ $participant->name }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

</x-typing-app>
