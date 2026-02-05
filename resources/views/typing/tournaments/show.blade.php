<x-typing-app :role="auth()->user()->role" :title="$tournament->name . ' - ระบบวิชาพิมพ์หนังสือราชการ 1'">
    <div class="space-y-10 pb-12">

        <!-- Aurora & Glass Header -->
        @php
            $isBracket = $tournament->type !== 'class_battle';
            $hColor1 = $isBracket ? 'from-amber-400 to-orange-600' : 'from-indigo-500 to-purple-600';
            $hBg = $isBracket ? 'from-amber-50/30 to-orange-50/20' : 'from-indigo-50/30 to-purple-50/20';
            $shadowColor = $isBracket ? 'hover:shadow-amber-500/10' : 'hover:shadow-indigo-500/10';
        @endphp

        <div class="relative overflow-hidden bg-white border border-white/40 rounded-[2.5rem] p-8 md:p-10 shadow-2xl group transition-all duration-500 {{ $shadowColor }}">
            <!-- Aurora Background -->
            <div class="absolute inset-0 bg-gradient-to-br from-white {{ $hBg }} opacity-80"></div>
            <div class="absolute top-[-30%] right-[-10%] w-[600px] h-[600px] bg-gradient-to-br from-primary-300/10 via-indigo-300/10 to-purple-200/10 rounded-full blur-[80px] animate-pulse-slow pointer-events-none mix-blend-multiply"></div>
            
            <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-8">
                <div class="flex items-center gap-6">
                    <div class="w-20 h-20 rounded-[2rem] bg-gradient-to-br {{ $hColor1 }} text-white flex items-center justify-center shadow-2xl transform group-hover:rotate-6 transition-all duration-500">
                        <i class="fas {{ $isBracket ? 'fa-sitemap' : 'fa-users-class' }} text-4xl"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-3 mb-1">
                            <a href="{{ route('typing.tournaments.index') }}" class="w-8 h-8 rounded-full bg-white/50 flex items-center justify-center text-gray-400 hover:text-primary-500 hover:bg-white transition-all shadow-sm">
                                <i class="fas fa-arrow-left text-xs"></i>
                            </a>
                            <h1 class="text-3xl md:text-4xl font-black text-gray-800 tracking-tight">{{ $tournament->name }}</h1>
                        </div>
                        <p class="text-gray-500 font-medium flex items-center gap-3 text-lg">
                            {{ $tournament->description }}
                        </p>
                        
                        <div class="mt-4 flex flex-wrap items-center gap-4">
                            @if($tournament->status === 'open')
                                <span class="px-4 py-1.5 rounded-2xl bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-widest border border-emerald-100 flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                    เปิดรับสมัคร
                                </span>
                            @elseif($tournament->status === 'ongoing')
                                <span class="px-4 py-1.5 rounded-2xl bg-blue-50 text-blue-600 text-[10px] font-black uppercase tracking-widest border border-blue-100 flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                                    กำลังแข่งขัน
                                </span>
                            @else
                                <span class="px-4 py-1.5 rounded-2xl bg-gray-50 text-gray-400 text-[10px] font-black uppercase tracking-widest border border-gray-100 flex items-center gap-2">
                                    <i class="fas fa-flag-checkered"></i>
                                    จบการแข่งขันแล้ว
                                </span>
                            @endif
                            <span class="text-xs font-black text-gray-400 uppercase tracking-widest bg-gray-50 px-4 py-1.5 rounded-2xl border border-gray-100">
                                <i class="fas fa-users mr-1 text-primary-500"></i>
                                ผู้เข้าร่วม: {{ $tournament->participants->count() }} / {{ $tournament->max_participants }} คน
                            </span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap gap-4">
                    @if($tournament->status === 'open')
                        @if(!$tournament->participants->contains(Auth::id()))
                            <form action="{{ route('typing.tournaments.join', $tournament->id) }}" method="POST">
                                @csrf
                                <button type="submit" 
                                    class="group/btn flex items-center gap-3 px-10 py-5 bg-primary-500 text-white font-black rounded-2xl hover:bg-primary-600 hover:shadow-2xl hover:-translate-y-1 transition-all shadow-xl shadow-primary-500/20 overflow-hidden relative">
                                    <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 translate-x-[-100%] group-hover/btn:translate-x-[100%] transition-transform duration-1000"></div>
                                    <i class="fas fa-sign-in-alt transition-transform group-hover/btn:translate-x-1"></i>
                                    ร่วมการแข่งขัน
                                </button>
                            </form>
                        @else
                            <div class="flex items-center gap-3 px-8 py-4 rounded-2xl bg-emerald-50 text-emerald-600 font-black border border-emerald-100">
                                <i class="fas fa-check-circle text-xl"></i>
                                คุณลงทะเบียนแล้ว
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>

        <!-- Class Battle Layout -->
        @if($tournament->type === 'class_battle')
            <div class="bg-white rounded-[3rem] shadow-xl border border-gray-100 p-8 md:p-12 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-50/50 rounded-bl-full -mr-32 -mt-32"></div>

                <div class="relative z-10">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
                        <div>
                            <h2 class="text-3xl font-black text-gray-800 tracking-tight">
                                <i class="fas fa-list-ol text-indigo-500 mr-3"></i>
                                Live Leaderboard
                            </h2>
                            <p class="text-gray-400 font-bold uppercase tracking-widest text-[10px] mt-1 ml-11">ตารางคะแนนล่าสุดแบบเรียลไทม์</p>
                        </div>
                        
                        @if($tournament->status === 'ongoing')
                            @php
                                $myMatch = $tournament->matches->where('player1_id', Auth::id())->first();
                            @endphp
                            
                            <div class="flex flex-wrap gap-4 w-full md:w-auto">
                                @if($isAdmin && !$tournament->race_started_at)
                                    <form action="{{ route('typing.tournaments.start-race', $tournament->id) }}" method="POST" class="flex-1 md:flex-none">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center justify-center gap-3 px-8 py-4 bg-indigo-600 text-white font-black rounded-2xl hover:bg-indigo-700 hover:shadow-xl hover:-translate-y-1 transition-all">
                                            <i class="fas fa-flag-checkered"></i>
                                            เริ่มการแข่งขันพร้อมกัน
                                        </button>
                                    </form>
                                @endif

                                @if($myMatch)
                                    <a href="{{ route('typing.student.matches.show', $myMatch->id) }}" 
                                        class="flex-1 md:flex-none flex items-center justify-center gap-3 px-10 py-4 bg-orange-500 text-white font-black rounded-2xl hover:bg-orange-600 hover:shadow-xl hover:-translate-y-1 transition-all animate-pulse-slow">
                                        <i class="fas fa-gamepad text-xl"></i>
                                        เริ่มพิมพ์ตอนนี้!
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="overflow-x-auto rounded-[2rem] border border-gray-100 shadow-sm bg-gray-50/50">
                        <table class="min-w-full">
                            <thead>
                                <tr class="bg-white/80 border-b border-gray-100">
                                    <th class="px-8 py-6 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Rank</th>
                                    <th class="px-8 py-6 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Contestant</th>
                                    <th class="px-8 py-6 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Score / Reward</th>
                                    <th class="px-8 py-6 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Speed (WPM)</th>
                                    <th class="px-8 py-6 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Accuracy</th>
                                    <th class="px-8 py-6 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @php
                                    $matchesWithActivity = $tournament->matches->whereIn('status', ['completed', 'ongoing'])->sortByDesc('player1_wpm');
                                    $pendingMatches = $tournament->matches->whereNotIn('status', ['completed', 'ongoing']);
                                    $sortedMatches = $matchesWithActivity->concat($pendingMatches);
                                    $rank = 1;
                                @endphp
                                @forelse($sortedMatches as $match)
                                    <tr class="transition-colors hover:bg-white/50 {{ Auth::id() === $match->player1_id ? 'bg-indigo-50/80' : 'bg-white/30' }}">
                                        <td class="px-8 py-6 whitespace-nowrap">
                                            @if($rank == 1) <span class="text-3xl">🥇</span>
                                            @elseif($rank == 2) <span class="text-3xl">🥈</span>
                                            @elseif($rank == 3) <span class="text-3xl">🥉</span>
                                            @else <span class="text-lg font-black text-gray-300">#{{ $rank }}</span>
                                            @endif
                                        </td>
                                        <td class="px-8 py-6 whitespace-nowrap">
                                            <div class="flex items-center gap-4">
                                                <div class="relative">
                                                    <img class="h-12 w-12 rounded-2xl object-cover ring-2 ring-white shadow-md" src="{{ $match->player1->avatar_url }}" alt="">
                                                    @if(Auth::id() === $match->player1_id)
                                                        <div class="absolute -top-1 -right-1 w-4 h-4 rounded-full bg-primary-500 border-2 border-white shadow-sm"></div>
                                                    @endif
                                                </div>
                                                <div>
                                                    <p class="font-black text-gray-800">{{ $match->player1->name }}</p>
                                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">{{ $match->player1->student_id ?? 'STUDENT' }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-8 py-6 whitespace-nowrap">
                                            @if($match->status === 'completed')
                                                @php
                                                    $points = 0;
                                                    $config = $tournament->scoring_config ?? ['first_place' => 100, 'second_place' => 90, 'third_place' => 80, 'decrement' => 2, 'min_points' => 10];
                                                    if (is_string($config)) $config = json_decode($config, true);

                                                    if (isset($config['use_wpm_as_points']) && $config['use_wpm_as_points']) {
                                                        $points = intval($match->player1_wpm);
                                                    } else {
                                                        if ($rank === 1) $points = intval($config['first_place'] ?? 100);
                                                        else if ($rank === 2) $points = intval($config['second_place'] ?? 90);
                                                        else if ($rank === 3) $points = intval($config['third_place'] ?? 80);
                                                        else {
                                                            $base = intval($config['third_place'] ?? 80);
                                                            $decr = intval($config['decrement'] ?? 2);
                                                            $min = intval($config['min_points'] ?? 10);
                                                            $points = max($min, $base - (($rank - 3) * $decr));
                                                        }
                                                    }
                                                @endphp
                                                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-xl bg-amber-50 text-amber-600 font-black border border-amber-100 shadow-sm">
                                                    <i class="fas fa-star text-xs"></i>
                                                    +{{ $points }} PTS
                                                </div>
                                            @else
                                                <span class="text-gray-300 font-black lowercase tracking-widest text-xs">waiting...</span>
                                            @endif
                                        </td>
                                        <td class="px-8 py-6 whitespace-nowrap">
                                            <div class="text-2xl font-black {{ $match->player1_wpm > 60 ? 'text-emerald-500' : 'text-gray-800' }}">
                                                {{ $match->player1_wpm ?: '0' }}
                                                <span class="text-[10px] text-gray-400 font-bold uppercase tracking-tighter ml-1">wpm</span>
                                            </div>
                                        </td>
                                        <td class="px-8 py-6 whitespace-nowrap">
                                            <div class="flex items-center gap-2">
                                                <div class="w-16 h-2 bg-gray-100 rounded-full overflow-hidden">
                                                    <div class="h-full bg-emerald-400 rounded-full" style="width: {{ $match->player1_accuracy }}%"></div>
                                                </div>
                                                <span class="text-sm font-black text-gray-500">{{ $match->player1_accuracy }}%</span>
                                            </div>
                                        </td>
                                        <td class="px-8 py-6 whitespace-nowrap">
                                            @if($match->status === 'completed')
                                                <span class="px-3 py-1 rounded-lg bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-widest border border-emerald-100">
                                                    Finished
                                                </span>
                                            @elseif($match->status === 'ongoing')
                                                <span class="px-3 py-1 rounded-lg bg-yellow-50 text-yellow-600 text-[10px] font-black uppercase tracking-widest border border-yellow-100 animate-pulse">
                                                    Typing...
                                                </span>
                                            @else
                                                <span class="px-3 py-1 rounded-lg bg-gray-50 text-gray-400 text-[10px] font-black uppercase tracking-widest border border-gray-100">
                                                    Pending
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                    @php $rank++; @endphp
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-8 py-20 text-center">
                                            <div class="w-20 h-20 bg-gray-50 rounded-3xl flex items-center justify-center mx-auto mb-4 text-gray-300">
                                                <i class="fas fa-users text-3xl"></i>
                                            </div>
                                            <h3 class="text-xl font-bold text-gray-400 uppercase tracking-widest">ยังไม่มีผู้เข้าร่วมการแข่งขัน</h3>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <!-- Bracket Visualization -->
            <div class="bg-white rounded-[3rem] shadow-xl border border-gray-100 p-8 md:p-12 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-amber-50/50 rounded-bl-full -mr-32 -mt-32"></div>

                <div class="relative z-10">
                    <div class="mb-12">
                        <h2 class="text-3xl font-black text-gray-800 tracking-tight">
                            <i class="fas fa-sitemap text-amber-500 mr-3"></i>
                            สาย Bracket Tournament
                        </h2>
                        <p class="text-gray-400 font-bold uppercase tracking-widest text-[10px] mt-1 ml-11">เอาชนะคู่ต่อสู้เพื่อก้าวสู่รอบถัดไป</p>
                    </div>
                    
                    <div class="overflow-x-auto pb-12 cursor-grab active:cursor-grabbing scrollbar-hide">
                        <div class="min-w-max flex gap-12 lg:gap-20 px-4 items-center">
                            @php
                                $rounds = [1 => 'ROUND OF 16', 2 => 'ROUND OF 8', 3 => 'SEMI FINALS', 4 => 'THE FINALS'];
                                $matchCounts = [1 => 8, 2 => 4, 3 => 2, 4 => 1];
                            @endphp

                            @foreach($rounds as $roundNum => $roundName)
                                <div class="flex flex-col justify-around gap-12 lg:gap-20 py-4 min-h-[600px]">
                                    <h3 class="flex items-center justify-center gap-3 py-3 rounded-2xl bg-gray-50/80 backdrop-blur-md border border-gray-100 text-[10px] font-black text-gray-400 tracking-[0.2em] sticky top-0 z-20 shadow-sm">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        {{ $roundName }}
                                    </h3>
                                    
                                    @for($i = 0; $i < $matchCounts[$roundNum]; $i++)
                                        @php
                                            $match = $matchesByRound->get($roundNum)?->firstWhere('bracket_index', $i);
                                            $isOngoing = $match?->status === 'ongoing';
                                            $isCompleted = $match?->status === 'completed';
                                        @endphp
                                        
                                        <div class="relative w-64 lg:w-72">
                                            <!-- Connector Line (Visual only, simple version) -->
                                            @if($roundNum < 4)
                                                <div class="absolute -right-12 lg:-right-20 top-1/2 w-12 lg:w-20 h-px bg-gray-100"></div>
                                            @endif

                                            <div class="bg-white rounded-3xl border-2 transition-all duration-300 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1
                                                {{ $match ? ($isCompleted ? 'border-emerald-500 bg-emerald-50/20' : 'border-amber-400') : 'border-gray-100 border-dashed bg-gray-50/50 opacity-60' }}">
                                                
                                                <div class="p-4 space-y-2">
                                                    @if($match)
                                                        <!-- Player 1 -->
                                                        <div class="flex justify-between items-center p-2.5 rounded-2xl transition-colors
                                                            {{ $match->winner_id && $match->winner_id == $match->player1_id ? 'bg-emerald-500 text-white font-black shadow-lg shadow-emerald-500/30' : 'bg-gray-50 text-gray-800' }}">
                                                            <div class="flex items-center gap-3 min-w-0">
                                                                @if($match->player1)
                                                                    <img src="{{ $match->player1->avatar_url }}" class="w-8 h-8 rounded-xl object-cover shrink-0 border border-black/5">
                                                                    <span class="truncate text-xs font-bold">{{ $match->player1->name }}</span>
                                                                @else
                                                                    <span class="text-[10px] text-gray-400 italic">WAITING...</span>
                                                                @endif
                                                            </div>
                                                            @if($match->player1_wpm)
                                                                <span class="text-[10px] font-black px-2 py-0.5 rounded-lg bg-black/10">{{ $match->player1_wpm }}</span>
                                                            @endif
                                                        </div>

                                                        <div class="flex justify-center -my-1 relative z-10">
                                                            <div class="w-5 h-5 bg-white border border-gray-100 rounded-full flex items-center justify-center text-[8px] font-black text-gray-300">VS</div>
                                                        </div>

                                                        <!-- Player 2 -->
                                                        <div class="flex justify-between items-center p-2.5 rounded-2xl transition-colors
                                                            {{ $match->winner_id && $match->winner_id == $match->player2_id ? 'bg-emerald-500 text-white font-black shadow-lg shadow-emerald-500/30' : 'bg-gray-50 text-gray-800' }}">
                                                            <div class="flex items-center gap-3 min-w-0">
                                                                @if($match->player2)
                                                                    <img src="{{ $match->player2->avatar_url }}" class="w-8 h-8 rounded-xl object-cover shrink-0 border border-black/5">
                                                                    <span class="truncate text-xs font-bold">{{ $match->player2->name }}</span>
                                                                @else
                                                                    <span class="text-[10px] text-gray-400 italic">WAITING...</span>
                                                                @endif
                                                            </div>
                                                            @if($match->player2_wpm)
                                                                <span class="text-[10px] font-black px-2 py-0.5 rounded-lg bg-black/10">{{ $match->player2_wpm }}</span>
                                                            @endif
                                                        </div>

                                                        <!-- Match Action -->
                                                        @if(!$isCompleted)
                                                            @if(Auth::id() == $match->player1_id || Auth::id() == $match->player2_id)
                                                                <a href="{{ route('typing.student.matches.show', $match->id) }}" 
                                                                   class="mt-3 flex items-center justify-center gap-2 w-full py-2.5 rounded-xl bg-orange-500 text-white text-[10px] font-black uppercase tracking-widest hover:bg-orange-600 transition-all shadow-lg shadow-orange-500/20">
                                                                    <i class="fas fa-play text-[8px]"></i>
                                                                    Start Match
                                                                </a>
                                                            @endif
                                                        @else
                                                            <div class="absolute -top-3 -right-3 w-8 h-8 bg-emerald-500 text-white rounded-2xl flex items-center justify-center shadow-lg transform rotate-12">
                                                                <i class="fas fa-check text-xs"></i>
                                                            </div>
                                                        @endif
                                                    @else
                                                        <div class="h-20 flex flex-col items-center justify-center text-[10px] font-black text-gray-300 uppercase tracking-widest gap-2">
                                                            <i class="fas fa-lock animate-pulse"></i>
                                                            Locked Round
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Participants Section (Premium Bento) -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <!-- Active Participants -->
            <div class="lg:col-span-2 bg-white rounded-[3rem] p-8 md:p-10 shadow-xl border border-gray-100 flex flex-col">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h2 class="text-2xl font-black text-gray-800 tracking-tight">
                            <i class="fas fa-users text-primary-500 mr-3"></i>
                            ผู้เข้าร่วมการแข่งขัน
                        </h2>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">จำนวนทั้งหมด {{ $tournament->participants->count() }} คน</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
                    @foreach($tournament->participants as $participant)
                        <div class="group text-center">
                            <div class="relative inline-block mb-3">
                                <img src="{{ $participant->avatar_url }}" class="w-16 h-16 rounded-[2rem] mx-auto object-cover ring-4 ring-gray-50 group-hover:ring-primary-100 group-hover:scale-105 transition-all duration-300 shadow-md">
                                <div class="absolute -bottom-1 -right-1 w-6 h-6 rounded-xl bg-white flex items-center justify-center text-[10px] text-primary-500 font-black shadow-sm border border-gray-100">
                                    {{ $loop->iteration }}
                                </div>
                            </div>
                            <p class="font-black text-gray-800 text-xs truncate uppercase px-1">{{ $participant->name }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Non-Participants (Target list for teachers) -->
            @if(isset($nonParticipants) && count($nonParticipants) > 0)
                <div class="bg-red-50/30 rounded-[3rem] p-8 md:p-10 border border-red-100 flex flex-col">
                    <div class="mb-8">
                        <h2 class="text-2xl font-black text-red-500 tracking-tight">
                            <i class="fas fa-user-times mr-3"></i>
                            ยังไม่เข้าร่วม
                        </h2>
                        <p class="text-[10px] font-bold text-red-400 uppercase tracking-widest mt-1">{{ count($nonParticipants) }} คน ที่ยังไม่ลงชื่อ</p>
                    </div>
                    
                    <div class="flex flex-wrap gap-4">
                        @foreach($nonParticipants as $student)
                            <div class="flex items-center gap-3 bg-white/80 backdrop-blur-sm p-3 rounded-2xl border border-red-100 shadow-sm opacity-70 hover:opacity-100 transition-opacity">
                                <img src="{{ $student->avatar_url }}" class="w-8 h-8 rounded-xl object-cover grayscale">
                                <p class="font-bold text-gray-700 text-xs">{{ $student->name }}</p>
                            </div>
                        @endforeach
                    </div>

                    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'teacher')
                        <div class="mt-auto pt-10">
                            <button class="w-full py-4 rounded-2xl bg-red-500 text-white font-black text-xs uppercase tracking-widest hover:bg-red-600 shadow-lg shadow-red-500/20 transition-all flex items-center justify-center gap-3">
                                <i class="fas fa-bullhorn"></i>
                                ประกาศเรียกตัว
                            </button>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <style>
        .animate-pulse-slow { animation: pulse 8s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
        @keyframes pulse { 0%, 100% { opacity: 0.2; transform: scale(1); } 50% { opacity: 0.4; transform: scale(1.1); } }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</x-typing-app>
