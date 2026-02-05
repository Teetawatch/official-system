<x-typing-app :role="'student'" :title="'คลังเอกสารตัวอย่าง - ระบบวิชาพิมพ์หนังสือราชการ 1'">
    <div class="space-y-10 pb-12">
        
        <!-- Hero Section (Premium Aurora) -->
        <div class="relative overflow-hidden rounded-[3rem] bg-slate-950 shadow-2xl group min-h-[400px] flex items-center">
            <!-- Aurora & Glow Effects -->
            <div class="absolute inset-0 bg-gradient-to-br from-violet-600/20 via-transparent to-indigo-600/20 opacity-50"></div>
            <div class="absolute top-[-20%] right-[-10%] w-[600px] h-[600px] bg-gradient-to-br from-primary-500/20 via-indigo-500/20 to-purple-500/20 rounded-full blur-[100px] animate-pulse-slow pointer-events-none"></div>
            <div class="absolute bottom-[-20%] left-[-10%] w-[500px] h-[500px] bg-gradient-to-tr from-cyan-500/10 via-blue-500/10 to-transparent rounded-full blur-[100px] animate-pulse-slow pointer-events-none" style="animation-delay: 2s"></div>
            
            <!-- Grid Background Overlay -->
            <div class="absolute inset-0 bg-[url('https://parallel.report/assets/grid.svg')] bg-center [mask-image:linear-gradient(180deg,white,rgba(255,255,255,0))] opacity-10"></div>

            <div class="relative z-10 px-8 py-16 md:px-16 md:py-24 w-full flex flex-col lg:flex-row items-center justify-between gap-16">
                <div class="max-w-3xl text-center lg:text-left">
                    <div class="inline-flex items-center gap-3 px-5 py-2 rounded-full bg-white/5 border border-white/10 text-primary-400 text-xs font-black uppercase tracking-[0.3em] mb-8 backdrop-blur-xl animate-fade-in">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-primary-500"></span>
                        </span>
                        Premium Template Library
                    </div>
                    <h1 class="text-5xl md:text-7xl font-black text-white mb-8 leading-tight tracking-tight animate-slide-up">
                        คลังเอกสาร<br/>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-400 via-indigo-400 to-purple-400">ตัวอย่างระดับโปร</span>
                    </h1>
                    <p class="text-slate-400 text-lg md:text-xl leading-relaxed max-w-2xl mx-auto lg:mx-0 animate-slide-up" style="animation-delay: 0.1s">
                        ยกระดับทักษะการพิมพ์ด้วยเอกสารต้นแบบที่ถูกต้องตามระเบียบงานสารบรรณ 
                        คัดสรรชุดตัวอย่างคุณภาพสูงเพื่อการเรียนรู้ที่สมบูรณ์แบบ
                    </p>
                    
                    <div class="mt-12 flex flex-wrap items-center justify-center lg:justify-start gap-6 animate-slide-up" style="animation-delay: 0.2s">
                        <div class="flex -space-x-4">
                            @foreach([1, 2, 3, 4] as $i)
                                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-slate-800 to-slate-900 border-2 border-slate-950 flex items-center justify-center text-white font-black text-sm shadow-xl">
                                    <i class="fas {{ $i == 1 ? 'fa-file-pdf text-red-400' : ($i == 2 ? 'fa-file-word text-blue-400' : ($i == 3 ? 'fa-file-excel text-emerald-400' : 'fa-check text-primary-400')) }}"></i>
                                </div>
                            @endforeach
                        </div>
                        <div class="text-slate-400 text-sm font-medium">
                            รวมเอกสารคุณภาพ <span class="text-white font-black">100+ รายการ</span> พร้อมใช้งาน
                        </div>
                    </div>
                </div>
                
                <div class="hidden lg:block relative group-hover:scale-105 transition-transform duration-700 animate-float">
                    <div class="relative w-72 h-96 bg-gradient-to-br from-primary-500/20 to-indigo-600/20 rounded-[3rem] border border-white/10 backdrop-blur-3xl shadow-2xl flex flex-col p-8 overflow-hidden">
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-primary-500 to-transparent opacity-50"></div>
                        <div class="flex items-center gap-3 mb-8">
                            <div class="w-10 h-10 rounded-xl bg-primary-500 flex items-center justify-center text-white shadow-lg">
                                <i class="fas fa-crown"></i>
                            </div>
                            <div class="h-2 w-24 bg-white/10 rounded-full"></div>
                        </div>
                        <div class="space-y-4">
                            <div class="h-4 w-full bg-white/5 rounded-full"></div>
                            <div class="h-4 w-4/5 bg-white/5 rounded-full"></div>
                            <div class="h-4 w-full bg-white/5 rounded-full"></div>
                            <div class="h-4 w-3/4 bg-white/5 rounded-full"></div>
                        </div>
                        <div class="mt-auto space-y-4">
                            <div class="flex justify-between items-center">
                                <div class="h-8 w-8 bg-primary-500/20 rounded-lg"></div>
                                <div class="h-4 w-12 bg-white/5 rounded-full"></div>
                            </div>
                            <div class="h-12 w-full bg-gradient-to-r from-primary-500 to-indigo-600 rounded-2xl shadow-lg"></div>
                        </div>
                    </div>
                    <!-- Decorative Ring -->
                    <div class="absolute inset-0 -m-8 border border-primary-500/20 rounded-[4rem] animate-pulse-slow"></div>
                </div>
            </div>
        </div>

        <!-- Featured Section (Bento Grid Style) -->
        @if($featuredTemplates->count() > 0)
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-[1.25rem] bg-gradient-to-br from-amber-400 to-orange-500 text-white flex items-center justify-center shadow-2xl transform rotate-3">
                            <i class="fas fa-star text-lg"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-black text-gray-800 tracking-tight">เอกสารแนะนำพิเศษ</h2>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mt-0.5">Recommended by Instructors</p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($featuredTemplates as $template)
                        <a href="{{ route('typing.student.templates.show', $template) }}" 
                           class="group relative bg-white rounded-[2.5rem] border border-gray-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 overflow-hidden flex flex-col h-full">
                            <!-- Image/Preview Overlay -->
                            <div class="relative h-64 bg-slate-950 overflow-hidden">
                                @if($template->thumbnail)
                                    <img src="{{ asset('uploads/' . $template->thumbnail) }}" alt="{{ $template->title }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 opacity-60 group-hover:opacity-80">
                                @else
                                    <div class="absolute inset-0 flex flex-col items-center justify-center text-white/5 group-hover:text-white/10 transition-colors">
                                        <i class="fas fa-file-invoice text-9xl"></i>
                                        <p class="text-[10px] font-black uppercase tracking-[0.5em] mt-4">{{ $template->file_type }}</p>
                                    </div>
                                @endif

                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent to-transparent opacity-60"></div>

                                <!-- Floating Rarity Badge -->
                                <div class="absolute top-6 left-6 z-10">
                                    <span class="px-4 py-1.5 bg-gradient-to-r from-amber-400 to-orange-500 text-white text-[10px] font-black uppercase rounded-xl shadow-2xl flex items-center gap-2 border border-white/20">
                                        <i class="fas fa-star animate-pulse"></i> Featured
                                    </span>
                                </div>

                                <!-- Category Floating -->
                                <div class="absolute bottom-6 left-6 z-10">
                                    <span class="px-3 py-1 bg-white/10 backdrop-blur-md text-white/80 text-[10px] font-bold uppercase rounded-lg border border-white/10">
                                        {{ $template->category }}
                                    </span>
                                </div>
                            </div>

                            <!-- Content Section -->
                            <div class="p-8 flex flex-col flex-1">
                                <h3 class="font-black text-gray-800 text-xl leading-tight mb-4 group-hover:text-primary-600 transition-colors line-clamp-2">
                                    {{ $template->title }}
                                </h3>

                                @if($template->description)
                                    <p class="text-sm text-gray-500 line-clamp-2 mb-6 font-medium leading-relaxed">{{ $template->description }}</p>
                                @endif

                                <div class="mt-auto pt-6 border-t border-gray-50 flex items-center justify-between">
                                    <div class="flex items-center gap-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">
                                        <div class="flex items-center gap-1.5">
                                            <i class="fas fa-download text-primary-500"></i>
                                            {{ number_format($template->download_count) }}
                                        </div>
                                        <div class="flex items-center gap-1.5 text-blue-500">
                                            <i class="fas fa-hdd"></i>
                                            {{ $template->formatted_file_size }}
                                        </div>
                                    </div>
                                    <div class="w-10 h-10 rounded-xl bg-gray-50 text-gray-300 flex items-center justify-center group-hover:bg-primary-500 group-hover:text-white transition-all transform group-hover:rotate-12">
                                        <i class="fas fa-arrow-right text-sm"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Filter & Search (Glassmorphism) -->
        <div class="sticky top-6 z-40">
            <div class="bg-white/80 backdrop-blur-2xl rounded-[2.5rem] border border-white/40 shadow-2xl p-4 md:p-6 transition-all duration-300">
                <form method="GET" class="flex flex-col lg:flex-row gap-4">
                    <div class="flex-1 relative group">
                        <i class="fas fa-search absolute left-6 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-primary-500 transition-colors"></i>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="ค้นหาชื่อเอกสารตัวอย่างที่คุณต้องการ..." 
                               class="w-full pl-16 pr-6 py-4 rounded-[1.5rem] border-0 bg-gray-100/50 focus:bg-white focus:ring-[6px] focus:ring-primary-500/10 transition-all text-gray-800 font-bold placeholder:text-gray-400 placeholder:font-medium">
                    </div>
                    <div class="w-full lg:w-80 relative">
                        <i class="fas fa-filter absolute left-6 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <select name="category" class="w-full pl-16 pr-12 py-4 rounded-[1.5rem] border-0 bg-gray-100/50 focus:bg-white focus:ring-[6px] focus:ring-primary-500/10 transition-all text-gray-800 font-black tracking-tight appearance-none">
                            <option value="">ทุกหวดหมู่เอกสาร</option>
                            @foreach($categories as $key => $value)
                                <option value="{{ $key }}" {{ request('category') == $key ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                        <i class="fas fa-chevron-down absolute right-6 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-xs"></i>
                    </div>
                    
                    <button type="submit" class="group/btn relative px-10 py-4 bg-gray-900 text-white font-black rounded-[1.5rem] hover:bg-primary-600 hover:shadow-2xl hover:shadow-primary-500/30 hover:-translate-y-1 transition-all flex items-center justify-center gap-3 overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/10 to-white/0 translate-x-[-100%] group-hover/btn:translate-x-[100%] transition-transform duration-1000"></div>
                        <i class="fas fa-search text-sm transition-transform group-hover/btn:rotate-12"></i>
                        <span class="whitespace-nowrap">ค้นหาตอนนี้</span>
                    </button>

                    @if(request('search') || request('category'))
                        <a href="{{ route('typing.student.templates.index') }}" class="w-14 h-14 bg-gray-100/50 hover:bg-red-50 text-gray-400 hover:text-red-500 rounded-[1.5rem] flex items-center justify-center transition-all">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </form>
            </div>
        </div>

        <!-- All Templates Main Section -->
        <div class="space-y-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <h2 class="text-3xl font-black text-gray-800 tracking-tighter flex items-center gap-3">
                        <span class="w-2 h-8 bg-gradient-to-b from-primary-500 to-indigo-600 rounded-full"></span>
                        เอกสารตัวอย่างทั้งหมด
                    </h2>
                    <p class="text-sm font-bold text-gray-400 uppercase tracking-[0.2em] mt-2 ml-5">
                        Discover & Download ({{ $templates->total() }} Templates)
                    </p>
                </div>
            </div>

            <!-- Templates Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($templates as $template)
                    <a href="{{ route('typing.student.templates.show', $template) }}" 
                       class="group bg-white rounded-[2.5rem] border border-gray-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 overflow-hidden flex flex-col">
                        <!-- Card Image -->
                        <div class="relative h-48 bg-slate-50 flex items-center justify-center overflow-hidden">
                            @if($template->thumbnail)
                                <img src="{{ asset('uploads/' . $template->thumbnail) }}" alt="{{ $template->title }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            @else
                                <div class="text-center group-hover:scale-110 transition-transform duration-500">
                                    @php
                                        $iconClass = match (strtolower($template->file_type)) {
                                            'pdf' => 'fa-file-pdf text-red-500/10',
                                            'doc', 'docx' => 'fa-file-word text-blue-500/10',
                                            default => 'fa-file text-slate-200'
                                        };
                                        $textColor = match (strtolower($template->file_type)) {
                                            'pdf' => 'text-red-500',
                                            'doc', 'docx' => 'text-blue-500',
                                            default => 'text-gray-400'
                                        };
                                    @endphp
                                    <i class="fas {{ $iconClass }} text-7xl mb-2"></i>
                                    <p class="text-[9px] font-black uppercase tracking-[0.3em] {{ $textColor }}">{{ $template->file_type }}</p>
                                </div>
                            @endif

                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                            @if($template->is_featured)
                                <div class="absolute top-4 left-4">
                                    <span class="px-3 py-1 bg-amber-400/90 backdrop-blur-md text-amber-950 text-[10px] font-black uppercase rounded-lg shadow-lg">
                                        <i class="fas fa-star text-[8px]"></i> TOP
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- Card Body -->
                        <div class="p-6 flex flex-col flex-1">
                            <span class="inline-block px-3 py-1 bg-gray-50 text-[10px] font-black text-gray-400 uppercase tracking-widest rounded-lg border border-gray-100 mb-3 w-fit group-hover:bg-primary-50 group-hover:text-primary-500 group-hover:border-primary-100 transition-colors">
                                {{ $template->category }}
                            </span>
                            <h3 class="font-black text-gray-800 text-lg leading-tight mb-3 line-clamp-2 min-h-[3rem] group-hover:text-primary-600 transition-colors">
                                {{ $template->title }}
                            </h3>

                            <div class="mt-auto pt-4 border-t border-gray-50 flex items-center justify-between text-[10px] font-black text-gray-400 uppercase tracking-widest">
                                <span class="flex items-center gap-1.5">
                                    <i class="fas fa-download text-primary-500"></i> {{ number_format($template->download_count) }}
                                </span>
                                <span class="flex items-center gap-1.5">
                                    <i class="fas fa-eye text-indigo-500"></i> {{ number_format($template->view_count) }}
                                </span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full py-20">
                        <div class="bg-white/50 backdrop-blur-xl border-2 border-dashed border-gray-100 rounded-[3rem] p-20 text-center group">
                            <div class="w-24 h-24 bg-white rounded-[2rem] flex items-center justify-center mx-auto mb-8 text-gray-200 shadow-xl group-hover:scale-110 group-hover:rotate-6 transition-all">
                                <i class="fas fa-search text-5xl opacity-40"></i>
                            </div>
                            <h3 class="text-2xl font-black text-gray-800 mb-2">ไม่พบรายการที่ค้นหา</h3>
                            <p class="text-gray-400 font-medium max-w-sm mx-auto">ลองใช้คำค้นหาอื่น หรือเลือกหมวดหมู่ใหม่อีกครั้งเพื่อค้นหาสิ่งที่คุณต้องการ</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination (Modern Style) -->
            @if($templates->hasPages())
                <div class="flex justify-center pt-8">
                    {{ $templates->links() }}
                </div>
            @endif
        </div>

        <!-- Tips & Guidance Card -->
        <div class="relative overflow-hidden bg-slate-900 rounded-[3rem] p-10 md:p-14 text-white shadow-2xl group">
            <div class="absolute inset-0 bg-gradient-to-br from-primary-500/10 via-transparent to-indigo-600/10"></div>
            <div class="absolute top-0 right-0 w-96 h-96 bg-primary-500 opacity-10 rounded-full -mr-32 -mt-32 blur-[100px] animate-pulse-slow"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row items-center gap-10">
                <div class="w-24 h-24 rounded-[2rem] bg-white/5 backdrop-blur-xl border border-white/10 flex items-center justify-center flex-shrink-0 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-2xl">
                    <i class="fas fa-lightbulb text-amber-400 text-4xl shadow-glow"></i>
                </div>
                <div>
                    <h3 class="text-3xl font-black mb-4 tracking-tight">เคล็ดลับการใช้ประโยชน์จากเอกสารตัวอย่าง</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="flex items-start gap-4 p-4 rounded-2xl hover:bg-white/5 transition-colors group/tip">
                            <div class="w-8 h-8 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center flex-shrink-0 mt-1">
                                <i class="fas fa-check"></i>
                            </div>
                            <p class="text-slate-300 text-sm leading-relaxed">สังเกต<span class="text-white font-bold">ระยะขอบ</span>และการจัดวางองค์ประกอบต่างๆ เพื่อความถูกต้องตามระเบียบ</p>
                        </div>
                        <div class="flex items-start gap-4 p-4 rounded-2xl hover:bg-white/5 transition-colors group/tip">
                            <div class="w-8 h-8 rounded-full bg-blue-500/20 text-blue-400 flex items-center justify-center flex-shrink-0 mt-1">
                                <i class="fas fa-check"></i>
                            </div>
                            <p class="text-slate-300 text-sm leading-relaxed">ศึกษา<span class="text-white font-bold">ระดับภาษาแฟอร์มอล</span>ที่ใช้ในหนังสือแต่ละประเภท</p>
                        </div>
                        <div class="flex items-start gap-4 p-4 rounded-2xl hover:bg-white/5 transition-colors group/tip">
                            <div class="w-8 h-8 rounded-full bg-purple-500/20 text-purple-400 flex items-center justify-center flex-shrink-0 mt-1">
                                <i class="fas fa-check"></i>
                            </div>
                            <p class="text-slate-300 text-sm leading-relaxed">จดจำ<span class="text-white font-bold">โครงสร้างเอกสาร</span>เพื่อนำไปประยุกต์ใช้ในการฝึกพิมพ์</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .animate-pulse-slow { animation: pulse 6s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-fade-in { animation: fadeIn 1s ease-out; }
        .animate-slide-up { animation: slideUp 0.8s ease-out fill-mode: backwards; }
        
        @keyframes pulse { 0%, 100% { opacity: 0.8; } 50% { opacity: 0.3; } }
        @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-20px); } }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slideUp { 
            from { opacity: 0; transform: translateY(30px); } 
            to { opacity: 1; transform: translateY(0); } 
        }
        .shadow-glow { filter: drop-shadow(0 0 10px rgba(251, 191, 36, 0.5)); }
    </style>
</x-typing-app>
