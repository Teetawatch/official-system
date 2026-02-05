<x-typing-app :role="'student'" :title="'รายละเอียดงานที่ส่ง - ' . $submission->assignment->title">
    <div class="space-y-10 pb-12">
        
        <!-- Back Button & Premium Header -->
        <div class="space-y-6">
            <a href="{{ route('typing.student.submissions') }}" class="group inline-flex items-center gap-2 px-6 py-2.5 bg-white border border-gray-100 rounded-2xl text-sm font-black text-gray-500 hover:text-primary-600 hover:shadow-xl hover:-translate-x-1 transition-all">
                <i class="fas fa-arrow-left transition-transform group-hover:-translate-x-1"></i>
                กลับไปหน้ารายการงานที่ส่ง
            </a>

            <div class="relative overflow-hidden bg-white border border-white/40 rounded-[2.5rem] p-8 md:p-10 shadow-2xl group transition-all duration-500 hover:shadow-primary-500/10">
                <!-- Aurora Background -->
                <div class="absolute inset-0 bg-gradient-to-br from-white via-primary-50/30 to-indigo-50/20 opacity-80"></div>
                <div class="absolute top-[-30%] right-[-10%] w-[600px] h-[600px] bg-gradient-to-br from-indigo-300/10 via-primary-300/10 to-purple-200/10 rounded-full blur-[80px] animate-pulse-slow pointer-events-none mix-blend-multiply"></div>
                
                <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-8">
                    <div class="flex items-center gap-6">
                        <div class="w-20 h-20 rounded-[2rem] bg-gradient-to-br from-primary-500 to-indigo-600 text-white flex items-center justify-center shadow-2xl transform group-hover:rotate-6 transition-all duration-500">
                            <i class="fas fa-file-invoice text-4xl"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-primary-500 uppercase tracking-[0.3em] mb-1">SUBMISSION DETAILS</p>
                            <h1 class="text-3xl md:text-4xl font-black text-gray-800 tracking-tight leading-tight">{{ $submission->assignment->title }}</h1>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 bg-white/50 backdrop-blur-md px-6 py-4 rounded-3xl border border-white/50 shadow-sm">
                        <div class="text-right">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1 text-center">SUBMITTED ON</p>
                            <p class="text-lg font-black text-gray-800">{{ $submission->created_at->format('d M Y') }} <span class="text-sm opacity-60 ml-1">{{ $submission->created_at->format('H:i') }}</span></p>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-500 flex items-center justify-center">
                            <i class="far fa-clock text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Metrics Bento Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $metrics = [
                    [
                        'label' => 'คะแนนที่ได้',
                        'value' => $submission->score ?? '-',
                        'sub' => '/ ' . $submission->assignment->max_score,
                        'icon' => 'fa-trophy',
                        'color' => 'from-amber-400 to-orange-500',
                        'status' => $submission->score !== null ? 'ตรวจแล้ว' : 'รอตรวจ',
                        'statusStyle' => $submission->score !== null ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-amber-50 text-amber-600 border-amber-100'
                    ],
                    [
                        'label' => 'ความเร็วเฉลี่ย',
                        'value' => $submission->wpm,
                        'sub' => 'WPM',
                        'icon' => 'fa-tachometer-alt',
                        'color' => 'from-blue-500 to-indigo-600',
                    ],
                    [
                        'label' => 'ความแม่นยำ',
                        'value' => $submission->accuracy,
                        'sub' => '%',
                        'icon' => 'fa-crosshairs',
                        'color' => 'from-emerald-400 to-teal-600',
                    ],
                    [
                        'label' => 'เวลาที่ใช้',
                        'value' => gmdate('i:s', $submission->time_taken),
                        'sub' => 'MINS',
                        'icon' => 'fa-hourglass-half',
                        'color' => 'from-purple-500 to-pink-600',
                    ],
                ];
            @endphp

            @foreach($metrics as $m)
                <div class="group relative overflow-hidden bg-white rounded-[2.5rem] p-8 border border-gray-100 shadow-sm transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br {{ $m['color'] }} opacity-[0.03] rounded-bl-[4rem] group-hover:scale-110 transition-transform"></div>
                    
                    <div class="relative z-10 flex flex-col h-full">
                        <div class="w-14 h-14 rounded-[1.25rem] bg-gradient-to-br {{ $m['color'] }} text-white flex items-center justify-center shadow-lg mb-6 group-hover:rotate-6 transition-all">
                            <i class="fas {{ $m['icon'] }} text-xl"></i>
                        </div>
                        
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">{{ $m['label'] }}</p>
                        
                        <div class="flex items-baseline gap-2 mt-auto">
                            <span class="text-4xl font-black text-gray-800 tracking-tighter">{{ $m['value'] }}</span>
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">{{ $m['sub'] }}</span>
                        </div>

                        @if(isset($m['status']))
                            <div class="mt-4 flex">
                                <span class="px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest border {{ $m['statusStyle'] }}">
                                    {{ $m['status'] }}
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Content & Details -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <!-- Left Column: Assignment Details -->
            <div class="lg:col-span-2 space-y-10">
                <div class="bg-white rounded-[2.5rem] p-8 md:p-10 border border-gray-100 shadow-sm transition-all duration-500 hover:shadow-2xl overflow-hidden relative group">
                    <!-- Subtle pattern bg -->
                    <div class="absolute inset-0 opacity-[0.03] pointer-events-none group-hover:opacity-[0.05] transition-opacity" style="background-image: radial-gradient(#6366f1 1px, transparent 1px); background-size: 20px 20px;"></div>
                    
                    <div class="relative z-10">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-500 flex items-center justify-center">
                                <i class="fas fa-info-circle text-lg"></i>
                            </div>
                            <h3 class="text-2xl font-black text-gray-800 tracking-tight">ข้อมูลแบบฝึกหัด</h3>
                        </div>

                        <div class="space-y-6">
                            <div class="bg-gray-50/50 rounded-3xl p-8 border border-gray-100">
                                <p class="text-gray-600 leading-relaxed font-medium mb-6">{{ $submission->assignment->description ?: 'ไม่มีรายละเอียดเพิ่มเติมสำหรับบทเรียนนี้' }}</p>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="flex items-center gap-4 p-4 bg-white rounded-2xl border border-gray-100 shadow-sm">
                                        <div class="w-10 h-10 rounded-xl bg-orange-50 text-orange-500 flex items-center justify-center">
                                            <i class="fas {{ $submission->assignment->submission_type === 'typing' ? 'fa-keyboard' : 'fa-file-upload' }}"></i>
                                        </div>
                                        <div>
                                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1">Submission Type</p>
                                            <p class="text-sm font-black text-gray-700">{{ $submission->assignment->submission_type === 'typing' ? 'พิมพ์ในระบบ' : 'อัปโหลดไฟล์' }}</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-4 p-4 bg-white rounded-2xl border border-gray-100 shadow-sm">
                                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-500 flex items-center justify-center">
                                            <i class="fas fa-calendar-check"></i>
                                        </div>
                                        <div>
                                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1">Due Date</p>
                                            <p class="text-sm font-black {{ $submission->created_at->gt($submission->assignment->due_date) ? 'text-red-500' : 'text-emerald-600' }}">
                                                {{ $submission->assignment->due_date ? $submission->assignment->due_date->format('d M Y H:i') : 'ไม่มีกำหนด' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CTA: Try Again -->
                <div class="relative overflow-hidden bg-gray-900 rounded-[2.5rem] p-8 md:p-10 shadow-2xl flex flex-col md:flex-row items-center justify-between gap-8 group">
                    <div class="absolute inset-0 bg-gradient-to-r from-primary-600/20 to-indigo-600/20 opacity-40"></div>
                    <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-primary-500/10 rounded-full blur-[100px] group-hover:scale-110 transition-transform"></div>
                    
                    <div class="relative z-10">
                        <h3 class="text-2xl font-black text-white tracking-tight mb-2">บทเรียนนี้ท้าทายคุณหรือไม่?</h3>
                        <p class="text-gray-400 font-medium tracking-wide">การฝึกฝนซ้ำๆ คือหัวใจสำคัญของการพิมพ์ที่แม่นยำและรวดเร็ว</p>
                    </div>

                    <a href="{{ route('typing.student.practice', $submission->assignment_id) }}" 
                       class="relative z-10 group/btn px-10 py-5 bg-white text-gray-900 font-black rounded-3xl hover:bg-primary-500 hover:text-white transition-all overflow-hidden flex items-center gap-3">
                        <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/10 to-white/0 translate-x-[-100%] group-hover/btn:translate-x-[100%] transition-transform duration-1000"></div>
                        <i class="fas fa-redo transition-transform group-hover/btn:rotate-180 duration-700"></i>
                        <span>เริ่มฝึกใหม่อีกครั้ง</span>
                    </a>
                </div>
            </div>

            <!-- Right Column: Files & Tips -->
            <div class="space-y-10">
                @if($submission->file_path)
                    <div class="bg-white rounded-[2.5rem] p-8 border border-gray-100 shadow-sm hover:shadow-2xl transition-all">
                        <h3 class="text-xl font-black text-gray-800 tracking-tight mb-6">ไฟล์งานที่ส่ง</h3>
                        <div class="relative group/file">
                            <div class="absolute inset-0 bg-gradient-to-br from-red-500/5 to-orange-500/5 rounded-[2rem] opacity-0 group-hover/file:opacity-100 transition-opacity"></div>
                            <div class="relative z-10 p-6 border-2 border-dashed border-gray-100 rounded-[2rem] bg-gray-50/50 flex flex-col items-center text-center group-hover/file:border-red-200 transition-all">
                                <div class="w-20 h-20 rounded-3xl bg-white shadow-xl flex items-center justify-center mb-4 transform group-hover/file:rotate-6 transition-transform">
                                    <i class="fas fa-file-invoice-dollar text-3xl text-red-500"></i>
                                </div>
                                <p class="font-black text-gray-800 text-sm truncate w-full px-4 mb-1">{{ $submission->file_name }}</p>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-6">{{ number_format($submission->file_metadata['size'] / 1024, 2) }} KB</p>
                                
                                <a href="{{ asset($submission->file_path) }}" target="_blank" 
                                   class="w-full py-3 bg-white border border-gray-200 text-gray-700 font-bold rounded-2xl hover:bg-gray-900 hover:text-white hover:border-gray-900 transition-all flex items-center justify-center gap-2">
                                    <i class="fas fa-cloud-download-alt"></i>
                                    Download File
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="relative overflow-hidden bg-gradient-to-br from-primary-600 to-indigo-700 rounded-[2.5rem] p-8 text-white shadow-2xl group">
                    <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full blur-3xl -mr-20 -mt-20 group-hover:scale-150 transition-transform duration-1000"></div>
                    <div class="relative z-10">
                        <div class="w-12 h-12 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center mb-6">
                            <i class="fas fa-lightbulb text-yellow-300 text-xl"></i>
                        </div>
                        <h3 class="text-xl font-black tracking-tight mb-4 uppercase tracking-[0.1em]">Student Pro Tip</h3>
                        <p class="text-primary-100 font-medium leading-relaxed italic border-l-2 border-primary-400 pl-4">
                            "การฝึกพิมพ์วันละ 15 นาทีอย่างสม่ำเสมอ จะช่วยพัฒนาความกล้ามเนื้อนิ้วและความเร็วได้ดีกว่าการฝึกหนักเพียงวันเดียว"
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .animate-pulse-slow { animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
        @keyframes pulse { 0%, 100% { opacity: 0.8; } 50% { opacity: 0.4; } }
    </style>
</x-typing-app>

