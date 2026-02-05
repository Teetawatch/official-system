<x-typing-app :role="'student'" :title="$template->title . ' - คลังเอกสารตัวอย่าง'">
    <div class="space-y-8 pb-12">
        <!-- Back Button & Page Header info -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <a href="{{ route('typing.student.templates.index') }}"
                class="group flex items-center gap-3 px-6 py-2.5 bg-white border border-gray-100 rounded-2xl text-sm font-black text-gray-400 hover:text-primary-600 hover:shadow-xl transition-all">
                <i class="fas fa-arrow-left transition-transform group-hover:-translate-x-1"></i>
                <span>BACK TO LIBRARY</span>
            </a>

            <div class="flex items-center gap-4">
                 <span class="px-4 py-1.5 rounded-xl bg-primary-50 text-[10px] font-black text-primary-500 uppercase tracking-widest border border-primary-100">
                    Document Details
                </span>
                <span class="px-4 py-1.5 rounded-xl bg-gray-50 text-[10px] font-black text-gray-400 uppercase tracking-widest border border-gray-100">
                    ID: #{{ str_pad($template->id, 5, '0', STR_PAD_LEFT) }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Main Content Area -->
            <div class="lg:col-span-8 space-y-8">
                <!-- Document Preview Card (Premium) -->
                <div class="bg-white rounded-[3rem] shadow-2xl shadow-slate-200/50 border border-white overflow-hidden group">
                    <!-- Aurora Preview Header -->
                    <div class="relative h-80 md:h-[500px] flex items-center justify-center overflow-hidden">
                        <!-- Aurora Background -->
                        <div class="absolute inset-0 bg-[#0f172a]"></div>
                        <div class="absolute top-[-20%] right-[-10%] w-[500px] h-[500px] bg-gradient-to-br from-primary-500/20 via-indigo-500/10 to-transparent rounded-full blur-[100px] animate-pulse-slow"></div>
                        <div class="absolute bottom-[-20%] left-[-10%] w-[400px] h-[400px] bg-gradient-to-tr from-purple-500/10 via-blue-500/10 to-transparent rounded-full blur-[80px] animate-pulse-slow" style="animation-delay: 2s"></div>
                        
                        <!-- Grid Overlay -->
                        <div class="absolute inset-0 bg-[url('https://parallel.report/assets/grid.svg')] bg-center opacity-10 pointer-events-none"></div>

                        <!-- Thumbnail or Placeholder -->
                        <div class="relative z-10 w-full h-full p-8 md:p-16 flex items-center justify-center">
                            @if($template->thumbnail)
                                <div class="relative group/img backdrop-blur-2xl p-2 rounded-[2rem] bg-white/5 border border-white/10 shadow-2xl transition-all duration-700 hover:scale-[1.02]">
                                    <img src="{{ asset('uploads/' . $template->thumbnail) }}" alt="{{ $template->title }}"
                                        class="max-w-full max-h-[350px] md:max-h-[450px] object-contain rounded-[1.5rem] shadow-2xl">
                                    <div class="absolute inset-0 rounded-[1.5rem] bg-gradient-to-t from-black/20 to-transparent pointer-events-none"></div>
                                </div>
                            @else
                                <div class="text-center group/placeholder">
                                    @php
                                        $iconInfo = match (strtolower($template->file_type)) {
                                            'pdf' => ['icon' => 'fa-file-pdf', 'color' => 'text-red-400', 'bg' => 'bg-red-500/10'],
                                            'doc', 'docx' => ['icon' => 'fa-file-word', 'color' => 'text-blue-400', 'bg' => 'bg-blue-500/10'],
                                            default => ['icon' => 'fa-file', 'color' => 'text-slate-400', 'bg' => 'bg-slate-500/10']
                                        };
                                    @endphp
                                    <div class="w-48 h-48 rounded-[3rem] {{ $iconInfo['bg'] }} backdrop-blur-xl border border-white/10 flex items-center justify-center mb-6 shadow-2xl group-hover/placeholder:scale-110 group-hover/placeholder:rotate-3 transition-all duration-500">
                                        <i class="fas {{ $iconInfo['icon'] }} {{ $iconInfo['color'] }} text-7xl"></i>
                                    </div>
                                    <p class="text-white/40 font-black text-sm uppercase tracking-[0.5em] group-hover/placeholder:tracking-[0.8em] transition-all duration-500">{{ $template->file_type }}</p>
                                </div>
                            @endif
                        </div>

                        <!-- Badges Overlay -->
                        <div class="absolute top-8 left-8 flex flex-col gap-3 z-30">
                            @if($template->is_featured)
                                <span class="px-5 py-2.5 bg-gradient-to-r from-amber-400 to-orange-500 text-white text-[10px] font-black uppercase tracking-widest rounded-[1.25rem] shadow-2xl flex items-center gap-2 border border-white/20">
                                    <i class="fas fa-star animate-pulse"></i> HIGH QUALITY
                                </span>
                            @endif
                            <span class="px-5 py-2.5 bg-white/10 backdrop-blur-xl text-white text-[10px] font-black uppercase tracking-widest rounded-[1.25rem] border border-white/10">
                                {{ $template->category }}
                            </span>
                        </div>
                    </div>

                    <!-- Content Section -->
                    <div class="p-8 md:p-12 relative">
                        <div class="flex flex-col md:flex-row md:items-start justify-between gap-8 mb-12">
                            <div class="flex-1">
                                <h1 class="text-3xl md:text-4xl font-black text-gray-800 tracking-tight leading-tight mb-6">
                                    {{ $template->title }}
                                </h1>
                                @if($template->description)
                                    <p class="text-lg text-gray-500 font-medium leading-relaxed max-w-3xl">
                                        {{ $template->description }}
                                    </p>
                                @endif
                            </div>
                            
                            <!-- Stats Chips -->
                            <div class="flex flex-wrap gap-4 md:flex-col">
                                <div class="flex items-center gap-3 px-6 py-3 bg-gray-50 rounded-2xl border border-gray-100">
                                    <i class="fas fa-download text-primary-500"></i>
                                    <span class="text-sm font-black text-gray-700">{{ number_format($template->download_count) }} <span class="text-[10px] text-gray-400 ml-1">GETS</span></span>
                                </div>
                                <div class="flex items-center gap-3 px-6 py-3 bg-gray-50 rounded-2xl border border-gray-100">
                                    <i class="fas fa-eye text-indigo-500"></i>
                                    <span class="text-sm font-black text-gray-700">{{ number_format($template->view_count) }} <span class="text-[10px] text-gray-400 ml-1">VIEWS</span></span>
                                </div>
                            </div>
                        </div>

                        <!-- Bento Info Grid (Redesigned) -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                            <div class="bg-gray-50 rounded-[2.5rem] p-8 border border-gray-100 group/item hover:bg-white hover:shadow-2xl hover:-translate-y-1 transition-all duration-500">
                                <div class="w-14 h-14 rounded-2xl bg-white shadow-sm flex items-center justify-center mb-6 group-hover/item:bg-primary-500 group-hover/item:text-white transition-colors">
                                    <i class="fas fa-file-invoice text-xl"></i>
                                </div>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">FILE TYPE</p>
                                <h4 class="text-xl font-black text-gray-800">{{ strtoupper($template->file_type) }} FORMAT</h4>
                            </div>

                            <div class="bg-gray-50 rounded-[2.5rem] p-8 border border-gray-100 group/item hover:bg-white hover:shadow-2xl hover:-translate-y-1 transition-all duration-500">
                                <div class="w-14 h-14 rounded-2xl bg-white shadow-sm flex items-center justify-center mb-6 group-hover/item:bg-indigo-500 group-hover/item:text-white transition-colors">
                                    <i class="fas fa-weight-hanging text-xl"></i>
                                </div>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">SIZE</p>
                                <h4 class="text-xl font-black text-gray-800">{{ $template->formatted_file_size }}</h4>
                            </div>

                            <div class="bg-gray-50 rounded-[2.5rem] p-8 border border-gray-100 group/item hover:bg-white hover:shadow-2xl hover:-translate-y-1 transition-all duration-500">
                                <div class="w-14 h-14 rounded-2xl bg-white shadow-sm flex items-center justify-center mb-6 group-hover/item:bg-purple-500 group-hover/item:text-white transition-colors">
                                    <i class="fas fa-tag text-xl"></i>
                                </div>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">CATEGORY</p>
                                <h4 class="text-xl font-black text-gray-800 truncate">{{ $template->category }}</h4>
                            </div>
                        </div>

                        <!-- Actions Bar (Premium) -->
                        <div class="p-4 bg-gray-50 rounded-[2rem] border border-gray-100 flex items-center gap-4">
                            <a href="{{ route('typing.student.templates.download', $template) }}"
                                class="flex-1 group/btn relative py-5 bg-gray-900 text-white font-black rounded-2xl hover:bg-primary-600 hover:shadow-2xl hover:shadow-primary-500/30 hover:-translate-y-1 transition-all overflow-hidden flex items-center justify-center gap-3">
                                <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/10 to-white/0 translate-x-[-100%] group-hover/btn:translate-x-[100%] transition-transform duration-1000"></div>
                                <i class="fas fa-cloud-download-alt text-xl transition-transform group-hover/btn:rotate-12"></i>
                                <span class="text-lg">DOWNLOAD NOW</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- How to Use Guidance (Premium Bento) -->
                <div class="bg-white rounded-[3rem] p-10 md:p-14 border border-gray-100 shadow-sm relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-primary-50/50 rounded-full blur-[80px] -mr-32 -mt-32"></div>
                    
                    <div class="relative z-10 flex flex-col md:flex-row items-center gap-10">
                        <div class="w-24 h-24 rounded-[2rem] bg-indigo-50 text-indigo-500 flex items-center justify-center flex-shrink-0 shadow-inner group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                            <i class="fas fa-graduation-cap text-4xl"></i>
                        </div>
                        <div class="flex-1">
                            <h2 class="text-3xl font-black text-gray-800 tracking-tight mb-4">แนวทางการเรียนรู้</h2>
                            <p class="text-gray-400 font-bold uppercase tracking-widest mb-10 text-xs">Steps to master this template</p>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                                <div class="space-y-4">
                                    <div class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center font-black text-gray-400 border border-gray-100 italic">01</div>
                                    <h4 class="font-black text-gray-800">สำรวจรูปแบบ</h4>
                                    <p class="text-sm text-gray-500 font-medium">สังเกตระยะขอบและตำแหน่งขององค์ประกอบทั้งหมด</p>
                                </div>
                                <div class="space-y-4">
                                    <div class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center font-black text-gray-400 border border-gray-100 italic">02</div>
                                    <h4 class="font-black text-gray-800">วิเคราะห์ภาษา</h4>
                                    <p class="text-sm text-gray-500 font-medium">ทำความเข้าใจระดับภาษาและรูปแบบการใช้คำเป็นทางการ</p>
                                </div>
                                <div class="space-y-4">
                                    <div class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center font-black text-gray-400 border border-gray-100 italic">03</div>
                                    <h4 class="font-black text-gray-800">ฝึกพิมพ์เสมือนจริง</h4>
                                    <p class="text-sm text-gray-500 font-medium">ใช้รูปแบบตัวอย่างเพื่อฝึกจัดวางเอกสารในโปรแกรมพิมพ์</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-4 space-y-8">
                <!-- Detailed File Info Card -->
                <div class="bg-white rounded-[2.5rem] p-8 border border-gray-100 shadow-sm">
                    <h3 class="font-black text-gray-800 text-lg flex items-center gap-3 mb-8 pb-6 border-b border-gray-50">
                        <i class="fas fa-info-circle text-primary-500"></i>
                        FILE SPECIFICATION
                    </h3>

                    <div class="space-y-6">
                        <div class="flex items-center justify-between group">
                            <span class="text-[10px] font-black text-gray-300 uppercase tracking-widest group-hover:text-primary-400 transition-colors">Filename</span>
                            <span class="text-xs font-black text-gray-700 max-w-[180px] truncate" title="{{ $template->file_name }}">{{ $template->file_name }}</span>
                        </div>
                        <div class="flex items-center justify-between group">
                            <span class="text-[10px] font-black text-gray-300 uppercase tracking-widest group-hover:text-indigo-400 transition-colors">Uploaded</span>
                            <span class="text-xs font-black text-gray-700">{{ $template->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="flex items-center justify-between group">
                            <span class="text-[10px] font-black text-gray-300 uppercase tracking-widest group-hover:text-purple-400 transition-colors">Permissions</span>
                            <span class="px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-600 text-[9px] font-black">READ & DOWNLOAD</span>
                        </div>
                    </div>

                    <div class="mt-10 p-4 rounded-3xl bg-gray-50 border border-gray-100 flex items-center gap-4">
                        <img src="{{ auth()->user()->avatar_url }}" alt="Uploader" class="w-10 h-10 rounded-xl object-cover">
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-tighter mt-0.5">Verified Asset</p>
                            <p class="text-xs font-black text-gray-800">System Official</p>
                        </div>
                    </div>
                </div>

                <!-- Related Content -->
                @if($relatedTemplates->count() > 0)
                    <div class="bg-white rounded-[2.5rem] p-8 border border-gray-100 shadow-sm">
                        <h3 class="font-black text-gray-800 text-lg flex items-center gap-3 mb-8">
                            <i class="fas fa-layer-group text-primary-500"></i>
                            RECOMMENDATIONS
                        </h3>

                        <div class="space-y-4">
                            @foreach($relatedTemplates as $related)
                                <a href="{{ route('typing.student.templates.show', $related) }}"
                                    class="group flex items-center gap-4 p-4 rounded-[1.5rem] bg-white border border-gray-50 hover:border-primary-100 hover:shadow-xl hover:shadow-primary-500/5 transition-all">
                                    <div class="w-12 h-12 rounded-xl bg-gray-50 flex items-center justify-center flex-shrink-0 group-hover:bg-primary-50 transition-colors">
                                        @php
                                            $relIcon = match (strtolower($related->file_type)) {
                                                'pdf' => 'fa-file-pdf text-red-500',
                                                'doc', 'docx' => 'fa-file-word text-blue-500',
                                                default => 'fa-file text-gray-400'
                                            };
                                        @endphp
                                        <i class="fas {{ $relIcon }} text-lg opacity-40 group-hover:opacity-100 transition-opacity"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-black text-gray-800 group-hover:text-primary-600 transition-colors truncate">
                                            {{ $related->title }}
                                        </p>
                                        <p class="text-[10px] font-bold text-gray-400 uppercase mt-0.5">{{ $related->formatted_file_size }} • {{ strtoupper($related->file_type) }}</p>
                                    </div>
                                    <i class="fas fa-chevron-right text-[10px] text-gray-300 group-hover:text-primary-500 group-hover:translate-x-1 transition-all"></i>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Fast Download Widget (High Impact) -->
                <div class="relative overflow-hidden bg-gradient-to-br from-primary-600 to-indigo-700 rounded-[2.5rem] p-8 text-white shadow-2xl group">
                    <div class="absolute inset-0 bg-white/10 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-1000"></div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center shadow-inner">
                                <i class="fas fa-bolt text-2xl text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-black text-lg tracking-tight">QUICK ACCESS</h4>
                                <p class="text-white/60 text-[10px] font-bold uppercase tracking-widest">Instant Download</p>
                            </div>
                        </div>
                        
                        <p class="text-sm font-medium text-white/80 leading-relaxed mb-8">
                            ต้องการข้อมูลแบบเร่งด่วน? คลิกที่นี่เพื่อดาวน์โหลดทันทีโดยไม่ต้องดูสถิติเพิ่มเติม
                        </p>

                        <a href="{{ route('typing.student.templates.download', $template) }}"
                            class="block w-full py-5 bg-white text-gray-900 font-black rounded-2xl hover:bg-gray-50 transition-all text-center group/btn shadow-xl shadow-black/10">
                            <span class="flex items-center justify-center gap-3">
                                <i class="fas fa-download transition-transform group-hover/btn:-translate-y-1"></i>
                                START DOWNLOAD
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .animate-pulse-slow { animation: pulse 6s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
        @keyframes pulse { 0%, 100% { opacity: 0.8; } 50% { opacity: 0.3; } }
        .shadow-glow { filter: drop-shadow(0 0 10px rgba(99, 102, 241, 0.3)); }
    </style>
</x-typing-app>