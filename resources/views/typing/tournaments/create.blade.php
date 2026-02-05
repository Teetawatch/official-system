<x-typing-app :role="auth()->user()->role" :title="'สร้างการแข่งขัน - ระบบวิชาพิมพ์หนังสือราชการ 1'">
    <div class="space-y-10 pb-12">

        <!-- Aurora & Glass Header -->
        <div
            class="relative overflow-hidden bg-white border border-white/40 rounded-[2.5rem] p-8 shadow-2xl group transition-all duration-500 hover:shadow-primary-500/10">
            <!-- Aurora Background -->
            <div class="absolute inset-0 bg-gradient-to-br from-white via-blue-50/50 to-indigo-50/30 opacity-80"></div>
            <div
                class="absolute top-[-30%] right-[-10%] w-[600px] h-[600px] bg-gradient-to-br from-blue-300/10 via-primary-300/10 to-indigo-200/10 rounded-full blur-[80px] animate-pulse-slow pointer-events-none mix-blend-multiply">
            </div>
            <div
                class="absolute bottom-[-20%] left-[-10%] w-[500px] h-[500px] bg-gradient-to-tr from-indigo-200/10 via-blue-200/10 to-purple-200/10 rounded-full blur-[80px] animate-pulse-slow delay-1000 pointer-events-none mix-blend-multiply">
            </div>

            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="flex items-center gap-6">
                    <div
                        class="w-16 h-16 rounded-2xl bg-gradient-to-br from-primary-500 to-indigo-600 text-white flex items-center justify-center shadow-lg shadow-primary-500/30 transform group-hover:rotate-6 transition-transform duration-500">
                        <i class="fas fa-plus text-3xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl md:text-4xl font-black text-gray-800 tracking-tight">สร้างการแข่งขันใหม่
                        </h1>
                        <p class="text-gray-500 mt-1 font-medium flex items-center gap-2 text-lg">
                            <span class="w-2 h-2 rounded-full bg-primary-500 animate-pulse"></span>
                            กำหนดรูปแบบและกติกาการแข่งขัน
                        </p>
                    </div>
                </div>

                <a href="{{ route('typing.tournaments.index') }}"
                    class="flex items-center gap-2 px-6 py-3 rounded-2xl bg-white/60 backdrop-blur-md border border-white text-gray-600 font-black hover:bg-gray-50 hover:shadow-xl hover:-translate-y-0.5 transition-all shadow-sm">
                    <i class="fas fa-arrow-left text-primary-500"></i>
                    ย้อนกลับ
                </a>
            </div>
        </div>

        <!-- Main Form Card -->
        <div class="bg-white rounded-[2.5rem] shadow-xl border border-gray-100 overflow-hidden relative"
            x-data="{ tournamentType: '{{ old('type', request('type') ?? 'bracket') }}' }">
            <div
                class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-primary-500 via-indigo-500 to-purple-600">
            </div>

            <form action="{{ route('typing.tournaments.store') }}" method="POST" class="p-8 md:p-12">
                @csrf
                <input type="hidden" name="is_submission" value="1">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8 mb-12">
                    <!-- Tournament Details -->
                    <div class="space-y-8">
                        <div>
                            <label
                                class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 px-2">ชื่อการแข่งขัน</label>
                            <div class="relative group">
                                <input type="text" name="name"
                                    class="w-full pl-12 pr-4 py-4 rounded-2xl bg-gray-50 border-transparent focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all font-bold text-gray-800 @error('name') border-red-500 bg-red-50 @enderror"
                                    value="{{ old('name', request('type') == 'class_battle' ? 'Classroom Battle Room #' . rand(1, 999) : 'Weekly Speed Cubing #' . rand(1, 999)) }}"
                                    required>
                                <div
                                    class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-primary-500 transition-colors">
                                    <i class="fas fa-trophy text-lg"></i>
                                </div>
                            </div>
                            @error('name') <p class="text-red-500 text-[10px] mt-1 font-bold px-2 uppercase">
                            {{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 px-2">รายละเอียด</label>
                            <div class="relative group">
                                <textarea name="description" rows="3"
                                    class="w-full pl-12 pr-4 py-4 rounded-2xl bg-gray-50 border-transparent focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all font-bold text-gray-800 @error('description') border-red-500 bg-red-50 @enderror"
                                    required>{{ old('description', request('type') == 'class_battle' ? 'Compete with the entire class! Free for all.' : 'A bracket tournament for the fastest typists!') }}</textarea>
                                <div
                                    class="absolute left-4 top-5 text-gray-400 group-focus-within:text-primary-500 transition-colors">
                                    <i class="fas fa-info-circle text-lg"></i>
                                </div>
                            </div>
                            @error('description') <p class="text-red-500 text-[10px] mt-1 font-bold px-2 uppercase">
                            {{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Type Selection -->
                    <div class="space-y-8">
                        <div>
                            <label
                                class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-6 px-2">รูปแบบการแข่งขัน</label>
                            <div class="grid grid-cols-2 gap-4">
                                <label class="group relative cursor-pointer">
                                    <input type="radio" name="type" value="bracket" x-model="tournamentType"
                                        class="sr-only">
                                    <div class="relative overflow-hidden p-6 rounded-[2rem] border-2 transition-all duration-300 flex flex-col items-center text-center gap-3"
                                        :class="tournamentType === 'bracket' ? 'border-amber-500 bg-amber-50/50' : 'border-gray-100 bg-white hover:border-gray-200'">
                                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-2xl transition-all duration-500"
                                            :class="tournamentType === 'bracket' ? 'bg-amber-500 text-white shadow-xl shadow-amber-500/20' : 'bg-gray-50 text-gray-400 group-hover:bg-amber-50 group-hover:text-amber-500'">
                                            <i class="fas fa-sitemap"></i>
                                        </div>
                                        <div>
                                            <h3 class="text-sm font-black text-gray-800">Bracket</h3>
                                            <p class="text-[10px] font-medium text-gray-500">1v1 จับคู่แพ้คัดออก</p>
                                        </div>
                                        <div x-show="tournamentType === 'bracket'"
                                            class="absolute top-3 right-3 text-amber-500">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                    </div>
                                </label>

                                <label class="group relative cursor-pointer">
                                    <input type="radio" name="type" value="class_battle" x-model="tournamentType"
                                        class="sr-only">
                                    <div class="relative overflow-hidden p-6 rounded-[2rem] border-2 transition-all duration-300 flex flex-col items-center text-center gap-3"
                                        :class="tournamentType === 'class_battle' ? 'border-indigo-500 bg-indigo-50/50' : 'border-gray-100 bg-white hover:border-gray-200'">
                                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-2xl transition-all duration-500"
                                            :class="tournamentType === 'class_battle' ? 'bg-indigo-500 text-white shadow-xl shadow-indigo-500/20' : 'bg-gray-50 text-gray-400 group-hover:bg-indigo-50 group-hover:text-indigo-500'">
                                            <i class="fas fa-users-class"></i>
                                        </div>
                                        <div>
                                            <h3 class="text-sm font-black text-gray-800">Class Battle</h3>
                                            <p class="text-[10px] font-medium text-gray-500">แข่งรวมรอบเดียวทั้งห้อง</p>
                                        </div>
                                        <div x-show="tournamentType === 'class_battle'"
                                            class="absolute top-3 right-3 text-indigo-500">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 px-2">จำนวนผู้เข้าร่วมสูงสุด</label>
                            <div class="relative group">
                                <input type="number" name="max_participants"
                                    class="w-full pl-12 pr-4 py-4 rounded-2xl bg-gray-50 border-transparent focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all font-bold text-gray-800 @error('max_participants') border-red-500 bg-red-50 @enderror"
                                    value="{{ old('max_participants', request('type') == 'class_battle' ? 100 : 16) }}">
                                <div
                                    class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-primary-500 transition-colors">
                                    <i class="fas fa-users text-lg"></i>
                                </div>
                            </div>
                            @error('max_participants') <p
                                class="text-red-500 text-[10px] mt-1 font-bold px-2 uppercase">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Game Settings (Premium Widget) -->
                <div
                    class="mb-12 p-8 rounded-[2.5rem] bg-indigo-50/50 border border-indigo-100 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-48 h-48 bg-indigo-100/50 rounded-bl-full -mr-16 -mt-16"></div>

                    <div class="relative z-10 space-y-8">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 rounded-2xl bg-white shadow-sm flex items-center justify-center text-indigo-500 text-xl font-black">
                                <i class="fas fa-gamepad"></i>
                            </div>
                            <h3 class="text-xl font-black text-gray-800 tracking-tight">Game Settings (ตั้งค่าสนามแข่ง)
                            </h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label
                                    class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 px-2">
                                    บทความแข่งขัน (Custom Text)
                                    <span class="text-[8px] opacity-70">(สุ่มให้อัตโนมัติหากปล่อยว่าง)</span>
                                </label>
                                <div class="relative group">
                                    <textarea name="custom_text" rows="4"
                                        class="w-full pl-12 pr-4 py-4 rounded-2xl bg-white border-transparent focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-mono font-bold text-gray-800 @error('custom_text') border-red-500 bg-red-50 @enderror"
                                        placeholder="พิมพ์หรือวางบทความที่ต้องการใช้แข่งขันที่นี่...">{{ old('custom_text') }}</textarea>
                                    <div
                                        class="absolute left-4 top-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                                        <i class="fas fa-quote-right text-lg"></i>
                                    </div>
                                </div>
                                @error('custom_text') <p class="text-red-500 text-[10px] mt-1 font-bold px-2 uppercase">
                                {{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label
                                    class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 px-2">จำกัดเวลาแข่งขัน
                                    (วินาที)</label>
                                <div class="relative group">
                                    <input type="number" name="time_limit" min="30" max="1800"
                                        class="w-full pl-12 pr-4 py-4 rounded-2xl bg-white border-transparent focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-bold text-gray-800 @error('time_limit') border-red-500 bg-red-50 @enderror"
                                        placeholder="เช่น 60, 120 (วินาที)" value="{{ old('time_limit') }}">
                                    <div
                                        class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                                        <i class="fas fa-clock text-lg"></i>
                                    </div>
                                </div>
                                @error('time_limit') <p class="text-red-500 text-[10px] mt-1 font-bold px-2 uppercase">
                                {{ $message }}</p> @enderror

                                <div
                                    class="mt-6 p-5 rounded-[2rem] bg-white/60 border border-indigo-100 flex items-start gap-4">
                                    <i class="fas fa-lightbulb text-indigo-400 mt-1"></i>
                                    <p class="text-[10px] font-black text-indigo-600 uppercase leading-loose">
                                        บทความยาวควรเพิ่มเวลาให้เหมาะสมเพื่อการแข่งขันที่ยุติธรรม</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Scoring Rules (Only for Class Battle) -->
                <div x-show="tournamentType === 'class_battle'" x-cloak x-transition:enter="duration-500 ease-out"
                    x-transition:enter-start="opacity-0 translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="mb-12 p-8 rounded-[2.5rem] bg-amber-50/50 border border-amber-100 relative overflow-hidden">
                    <div class="absolute bottom-0 left-0 w-32 h-32 bg-amber-100/50 rounded-tr-full -ml-16 -mb-16"></div>

                    <div class="relative z-10 space-y-8">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 rounded-2xl bg-white shadow-sm flex items-center justify-center text-amber-500 text-xl font-black">
                                <i class="fas fa-star"></i>
                            </div>
                            <h3 class="text-xl font-black text-gray-800 tracking-tight">Scoring Rules (กติกาการให้คะแนน)
                            </h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach(['first_place' => 'ที่ 1', 'second_place' => 'ที่ 2', 'third_place' => 'ที่ 3'] as $key => $label)
                                <div class="bg-white p-5 rounded-3xl border border-amber-100 shadow-sm relative">
                                    <label
                                        class="block text-[8px] font-black text-amber-500 uppercase tracking-widest mb-1">{{ $label }}
                                        จะได้รับ</label>
                                    <div class="relative group">
                                        <input type="number" name="scoring_config[{{ $key }}]"
                                            value="{{ 100 - ($loop->index * 10) }}"
                                            class="w-full text-2xl font-black text-gray-800 bg-transparent border-none p-0 focus:ring-0">
                                        <div class="absolute right-0 bottom-0 text-[10px] font-bold text-gray-300">PTS</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-4">
                                <div>
                                    <label
                                        class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 px-2">คะแนนที่ลดลงในแต่ละอันดับ</label>
                                    <div class="relative group">
                                        <input type="number" name="scoring_config[decrement]" value="2"
                                            class="w-full pl-6 pr-12 py-4 rounded-2xl bg-white border-transparent focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 transition-all font-black text-gray-800">
                                        <div
                                            class="absolute right-4 top-1/2 -translate-y-1/2 text-[10px] font-bold text-amber-400 uppercase">
                                            PTS / Rank</div>
                                    </div>
                                </div>
                                <div>
                                    <label
                                        class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 px-2">คะแนนขั้นต่ำที่ได้รับ</label>
                                    <div class="relative group">
                                        <input type="number" name="scoring_config[min_points]" value="10"
                                            class="w-full pl-6 pr-12 py-4 rounded-2xl bg-white border-transparent focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 transition-all font-black text-gray-800">
                                        <div
                                            class="absolute right-4 top-1/2 -translate-y-1/2 text-[10px] font-bold text-amber-400 uppercase">
                                            MIN PTS</div>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="p-8 rounded-[2.5rem] bg-white shadow-inner border border-amber-100 flex flex-col justify-center gap-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="font-black text-gray-800 leading-tight">ใช้ WPM เป็นคะแนนโดยตรง?</h4>
                                        <p class="text-[10px] font-medium text-gray-400 uppercase mt-1">
                                            ข้ามกติกาอันดับและใช้ความเร็วตัดสิน</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="scoring_config[use_wpm_as_points]" value="1"
                                            class="sr-only peer">
                                        <div
                                            class="w-14 h-8 bg-gray-100 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-amber-500 shadow-inner">
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="flex items-center justify-between pt-8 border-t border-gray-50">
                    <button type="reset"
                        class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest hover:text-gray-600 transition-colors">
                        ล้างข้อมูล
                    </button>
                    <button type="submit"
                        class="group relative flex items-center gap-3 px-12 py-5 bg-primary-500 text-white font-black rounded-2xl hover:bg-primary-600 hover:shadow-2xl hover:-translate-y-1 transition-all shadow-xl shadow-primary-500/20 overflow-hidden">
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-1000">
                        </div>
                        <i class="fas fa-check-circle group-hover:scale-110 transition-transform"></i>
                        ยืนยันสร้างการแข่งขัน
                    </button>
                </div>
            </form>
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

        [x-cloak] {
            display: none !important;
        }
    </style>
</x-typing-app>